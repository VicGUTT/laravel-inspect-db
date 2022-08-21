<?php

declare(strict_types=1);

use VicGutt\InspectDb\Inspect;
use Illuminate\Support\Facades\Schema;
use VicGutt\InspectDb\Entities\Entity;
use Illuminate\Database\Schema\Blueprint;
use VicGutt\InspectDb\Entities\ForeignKey;
use Doctrine\DBAL\Schema\ForeignKeyConstraint as ForeignKeySchema;

it('extends `VicGutt\InspectDb\Entities\Entity`', function (): void {
    expect(is_subclass_of(ForeignKey::class, Entity::class))->toEqual(true);
});

it('ForeignKey::$name', function (string $table, string $connection): void {
    $foreignKeys = Inspect::foreignKeys($table, $connection);

    if (in_array($table, ['users', 'media'], true)) {
        expect($foreignKeys->isEmpty())->toEqual(true);

        return;
    }

    expect($foreignKeys->count())->toEqual(1);

    $foreignKeys->each(static function (ForeignKey $foreignKey) use ($connection): void {
        expect($foreignKey->name)->toEqual($connection === 'sqlite' ? '' : 'posts_user_id_foreign');
    });
})->with('tables', 'connections');

it('ForeignKey::$localTableName', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->localTableName)->toEqual('posts');
})->with('connections');

it('ForeignKey::$localColumnNames', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->localColumnNames)->toEqual(['user_id']);
})->with('connections');

it('ForeignKey::$foreignTableName', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->foreignTableName)->toEqual('users');
})->with('connections');

it('ForeignKey::$foreignColumnNames', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->foreignColumnNames)->toEqual(['id']);
})->with('connections');

it('ForeignKey::$options', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    if ($connection === 'sqlite') {
        expect($foreignKey->options)->toEqual([
            'onDelete' => 'NO ACTION',
            'onUpdate' => 'NO ACTION',
            'deferrable' => false,
            'deferred' => false,
        ]);

        return;
    }

    expect($foreignKey->options)->toEqual(['onDelete' => null, 'onUpdate' => null]);
})->with('connections');

it('ForeignKey::$onUpdate', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->onUpdate)->toEqual(null);
})->with('connections');

it('ForeignKey::$onDelete', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->onDelete)->toEqual(null);
})->with('connections');

it('ForeignKey::$options | with defined values', function (string $connection): void {
    $table = '___';

    config()->set('database.default', $connection);

    Schema::create($table, static function (Blueprint $table): void {
        $table->foreignId('post_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    });

    $foreignKey = Inspect::foreignKeys($table, $connection)->first();

    expect($foreignKey->options)->toEqual(
        match ($connection) {
            'sqlite' => ['onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE', 'deferrable' => false, 'deferred' => false],
            default => ['onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE'],
        },
    );

    Schema::drop($table);

    config()->set('database.default', self::DEFAULT_CONNECTION);
})->with('connections');

it('ForeignKey::$onUpdate | with defined values', function (string $connection): void {
    $table = '___';

    config()->set('database.default', $connection);

    Schema::create($table, static function (Blueprint $table): void {
        $table->foreignId('post_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    });

    $foreignKey = Inspect::foreignKeys($table, $connection)->first();

    expect($foreignKey->onUpdate)->toEqual('CASCADE');

    Schema::drop($table);

    config()->set('database.default', self::DEFAULT_CONNECTION);
})->with('connections');

it('ForeignKey::$onDelete | with defined values', function (string $connection): void {
    $table = '___';

    config()->set('database.default', $connection);

    Schema::create($table, static function (Blueprint $table): void {
        $table->foreignId('post_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    });

    $foreignKey = Inspect::foreignKeys($table, $connection)->first();

    expect($foreignKey->onDelete)->toEqual('CASCADE');

    Schema::drop($table);

    config()->set('database.default', self::DEFAULT_CONNECTION);
})->with('connections');

it('ForeignKey::schema()', function (string $connection): void {
    $foreignKey = Inspect::foreignKeys('posts', $connection)->first();

    expect($foreignKey->schema() instanceof ForeignKeySchema)->toEqual(true);
})->with('connections');
