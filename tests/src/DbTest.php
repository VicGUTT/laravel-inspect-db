<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use Illuminate\Database\Connection;
use Doctrine\DBAL\Schema\Table as TableSchema;
use Doctrine\DBAL\Schema\AbstractSchemaManager as Schema;

it('can retrieve a database connection', function (): void {
    expect(Db::connection('testing') instanceof Connection)->toEqual(true);
    expect(Db::connection('testing')->getDatabaseName())->toEqual(config('database.connections.testing.database'));
    expect(Db::connection('sqlite')->getDatabaseName())->toEqual(config('database.connections.sqlite.database'));
    expect(Db::connection('mysql')->getDatabaseName())->toEqual(config('database.connections.mysql.database'));
});

it('can retrieve a database connection from a given connection', function (): void {
    expect(Db::connection(Db::connection('testing'))->getDatabaseName())->toEqual(config('database.connections.testing.database'));
    expect(Db::connection(Db::connection('sqlite'))->getDatabaseName())->toEqual(config('database.connections.sqlite.database'));
    expect(Db::connection(Db::connection('mysql'))->getDatabaseName())->toEqual(config('database.connections.mysql.database'));
});

it('uses the default database connection by default', function (): void {
    $detaultConnection = config('database.default');

    expect(Db::connection()->getDatabaseName())->toEqual(config("database.connections.{$detaultConnection}.database"));
});

it("can retrieve a connection's Doctrine Schema Manager", function (string $connection): void {
    expect(Db::schema($connection) instanceof Schema)->toEqual(true);

    $tables = Db::schema($connection)->listTableNames();

    expect($tables)->toEqualCanonicalizing(['media', 'posts', 'users']);
})->with('connections');

it("can retrieve a connection's Doctrine Schema Manager from a given connection", function (string $connection): void {
    $schema = Db::schema(Db::connection($connection));
    $tables = $schema->listTableNames();

    expect($tables)->toEqualCanonicalizing(['media', 'posts', 'users']);

    if ($connection !== 'sqlite') {
        expect(invade($schema)->_conn->getDatabase())->toEqual(config("database.connections.{$connection}.database"));

        return;
    }

    if ($this->runningInGithubCi) {
        expect(invade($schema)->_conn->getDatabase())->toEqual('main');

        return;
    }

    expect(invade($schema)->_conn->getDatabase())->toEqual('');
})->with('connections');

it("uses the default database connection by default to retrieve a connection's Doctrine Schema Manager", function (): void {
    $detaultConnection = config('database.default');
    $schema = Db::schema();

    expect($schema->listTableNames())->toEqual(['media', 'posts', 'users']);
    expect(invade($schema)->_conn->getDatabase())->toEqual(config("database.connections.{$detaultConnection}.database"));
});

it("can retrieve the connection's tables", function (string $connection): void {
    $tables = array_map(fn (TableSchema $table): string => $table->getName(), Db::tables($connection));

    expect($tables)->toEqualCanonicalizing(['media', 'posts', 'users']);
})->with('connections');

it("can retrieve the connection's tables from a given connection", function (string $connection): void {
    $tables = Db::tables(Db::connection($connection));
    $tables = array_map(fn (TableSchema $table): string => $table->getName(), $tables);

    expect($tables)->toEqualCanonicalizing(['media', 'posts', 'users']);
})->with('connections');

it("can retrieve the connection's tables from a given Doctrine Schema Manager", function (string $connection): void {
    $tables = Db::tables(Db::connection($connection));
    $tables = array_map(fn (TableSchema $table): string => $table->getName(), $tables);

    expect($tables)->toEqualCanonicalizing(['media', 'posts', 'users']);
})->with('connections');

it("uses the default database connection by default to retrieve a connection's tables", function (): void {
    expect(
        array_map(fn (TableSchema $table): string => $table->getName(), Db::tables()),
    )->toEqualCanonicalizing(['media', 'posts', 'users']);
});

it("can retrieve a table from a given connection", function (string $connection): void {
    expect(Db::table('user', $connection) instanceof TableSchema)->toEqual(true);
    expect(Db::table('user', Db::connection($connection)) instanceof TableSchema)->toEqual(true);
    expect(Db::table(Db::table('user'), Db::connection($connection)) instanceof TableSchema)->toEqual(true);
})->with('connections');

it("can retrieve a table from a given connection given a Doctrine Schema Manager", function (): void {
    expect(Db::table('user', Db::schema()) instanceof TableSchema)->toEqual(true);
    expect(Db::table(Db::table('user'), Db::schema()) instanceof TableSchema)->toEqual(true);
});

it("uses the default database connection by default to retrieve a given table", function (): void {
    expect(Db::table('user') instanceof TableSchema)->toEqual(true);
    expect(Db::table(Db::table('user')) instanceof TableSchema)->toEqual(true);
});
