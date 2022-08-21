<?php

declare(strict_types=1);

use VicGutt\InspectDb\Inspect;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Entities\Table;
use Illuminate\Support\Facades\Schema;
use VicGutt\InspectDb\Entities\Entity;
use Illuminate\Database\Schema\Blueprint;
use Doctrine\DBAL\Schema\Table as TableSchema;
use VicGutt\InspectDb\Collections\Entities\IndexCollection;
use VicGutt\InspectDb\Collections\Entities\ColumnCollection;
use VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection;

it('extends `VicGutt\InspectDb\Entities\Entity`', function (): void {
    expect(is_subclass_of(Table::class, Entity::class))->toEqual(true);
});

it('Table::$name', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->name)->toEqual($table);
})->with('tables', 'connections');

it('Table::$engine', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->engine)->toEqual($connection === 'mysql' ? 'InnoDB' : null);
})->with('tables', 'connections');

it('Table::$collation', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->collation)->toEqual($connection === 'mysql' ? 'utf8mb4_unicode_ci' : null);
})->with('tables', 'connections');

it('Table::$charset', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->charset)->toEqual($connection === 'mysql' ? 'utf8mb4' : null);
})->with('tables', 'connections');

it('Table::$autoincrement', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    if ($connection !== 'mysql') {
        expect($entity->autoincrement)->toEqual(null);

        return;
    }

    expect($entity->autoincrement)->toEqual($table === 'posts' ? 7 : 1);
})->with('tables', 'connections');

it('Table::$comment', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    if ($connection === 'sqlite') {
        expect($entity->comment)->toEqual(null);

        return;
    }

    if ($table === 'media') {
        expect($entity->comment)->toEqual('');

        return;
    }

    expect($entity->comment)->toEqual("This is the {$table} table");
})->with('tables', 'connections');

it('Table::$primaryKey', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->primaryKey instanceof Index)->toEqual(true);
    expect($entity->primaryKey->name)->toEqual(
        match ($connection) {
            'sqlite' => 'primary',
            'mysql' => 'PRIMARY',
            'pgsql' => "{$table}_pkey",
        },
    );
    expect($entity->primaryKey->unique)->toEqual(true);
    expect($entity->primaryKey->primary)->toEqual(true);
    expect($entity->primaryKey->columns)->toEqual(['id']);
    expect($entity->primaryKey->flags)->toEqual([]);
    expect($entity->primaryKey->options)->toEqual(['lengths' => [null]]);
    expect($entity->primaryKey->compound)->toEqual(false);
    expect($entity->primaryKey->primaryOrUnique)->toEqual(true);
    expect($entity->primaryKey->primaryAndUnique)->toEqual(true);
})->with('tables', 'connections');

it('Table::$primaryKey === null', function (string $connection): void {
    $table = '___';

    config()->set('database.default', $connection);

    Schema::create($table, static function (Blueprint $table): void {
        $table->string('_');
    });

    $entity = Inspect::table($table, $connection);

    expect(is_null($entity->primaryKey))->toEqual(true);

    Schema::drop($table);

    config()->set('database.default', self::DEFAULT_CONNECTION);
})->with('connections');

it('Table::$columns', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->columns instanceof ColumnCollection)->toEqual(true);
})->with('tables', 'connections');

it('Table::$indexes', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->indexes instanceof IndexCollection)->toEqual(true);
})->with('tables', 'connections');

it('Table::$foreignKeys', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->foreignKeys instanceof ForeignKeyCollection)->toEqual(true);
})->with('tables', 'connections');

it('Table::schema()', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);

    expect($entity->schema() instanceof TableSchema)->toEqual(true);
})->with('tables', 'connections');

it('Table::primaryKeyColumns()', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);
    $columns = $entity->primaryKeyColumns();

    expect($columns instanceof ColumnCollection)->toEqual(true);
    expect($columns->toBase()->pluck('name')->toArray())->toEqual(['id']);
})->with('tables', 'connections');

it('Table::foreignKeyColumns()', function (string $table, string $connection): void {
    $entity = Inspect::table($table, $connection);
    $columns = $entity->foreignKeyColumns();

    expect($columns instanceof ColumnCollection)->toEqual(true);

    if ($table !== 'posts') {
        expect($columns->isEmpty())->toEqual(true);

        return;
    }

    expect($columns->toBase()->pluck('name')->toArray())->toEqual(['user_id']);
})->with('tables', 'connections');
