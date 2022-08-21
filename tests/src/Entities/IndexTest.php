<?php

declare(strict_types=1);

use VicGutt\InspectDb\Inspect;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Entities\Entity;
use Doctrine\DBAL\Schema\Index as IndexSchema;

it('extends `VicGutt\InspectDb\Entities\Entity`', function (): void {
    expect(is_subclass_of(Index::class, Entity::class))->toEqual(true);
});

it('Index::$name', function (string $table, string $connection): void {
    $indices = match ($connection) {
        'sqlite' => [
            'users' => [
                'primary' => 'primary',
                'users_email_unique' => 'users_email_unique',
            ],
            'posts' => [
                'primary' => 'primary',
                'posts_slug_unique' => 'posts_slug_unique',
                'posts_name_index' => 'posts_name_index',
                'IDX_885DBAFAA76ED395' => 'IDX_885DBAFAA76ED395',
            ],
            'media' => [
                'primary' => 'primary',
                'media_order_column_index' => 'media_order_column_index',
                'media_uuid_unique' => 'media_uuid_unique',
                'media_model_type_model_id_index' => 'media_model_type_model_id_index',
            ],
        ],
        'mysql' => [
            'users' => [
                'PRIMARY',
                'users_email_unique',
            ],
            'posts' => [
                'PRIMARY',
                'posts_user_id_foreign',
                'posts_slug_unique',
                'posts_name_index',
                'custom_fulltext_index_name',
            ],
            'media' => [
                'PRIMARY',
                'media_uuid_unique',
                'media_model_type_model_id_index',
                'media_order_column_index',
            ],
        ],
        'pgsql' => [
            'users' => [
                'users_pkey',
                'users_email_unique',
            ],
            'posts' => [
                'posts_pkey',
                'posts_slug_unique',
                'posts_name_index',
                'IDX_885DBAFAA76ED395',
            ],
            'media' => [
                'media_pkey',
                'media_uuid_unique',
                'media_model_type_model_id_index',
                'media_order_column_index',
            ],
        ],
    };

    $indexes = Inspect::indexes($table, $connection);
    $indices = $indices[$table];

    $indexes->each(static function (Index $index) use ($indices): void {
        expect(in_array($index->name, $indices, true))->toEqual(true);
    });

    foreach ($indices as $index) {
        expect($indexes->get($index)->name)->toEqual($index);
    }
})->with('tables', 'connections');

it('Index::$primary', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index) use ($table, $connection): void {
        expect($index->primary)->toEqual(
            match ($connection) {
                'sqlite' => $index->name === 'primary',
                'mysql' => $index->name === 'PRIMARY',
                'pgsql' => $index->name === "{$table}_pkey",
            },
        );
    });
})->with('tables', 'connections');

it('Index::$unique', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index) use ($table, $connection): void {
        expect($index->unique)->toEqual(
            match ($connection) {
                'sqlite' => in_array($index->name, ['primary', 'users_email_unique', 'posts_slug_unique', 'media_uuid_unique'], true),
                'mysql' => in_array($index->name, ['PRIMARY', 'users_email_unique', 'posts_slug_unique', 'media_uuid_unique'], true),
                'pgsql' => in_array($index->name, ["{$table}_pkey", 'users_email_unique', 'posts_slug_unique', 'media_uuid_unique'], true),
            },
        );
    });
})->with('tables', 'connections');

it('Index::$columns', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index) use ($table, $connection): void {
        if ($connection === 'sqlite') {
            expect($index->columns)->toEqual(
                match ($index->name) {
                    'primary' => ['id'],
                    'users_email_unique' => ['email'],
                    'posts_slug_unique' => ['slug'],
                    'posts_name_index' => ['name'],
                    'media_uuid_unique' => ['uuid'],
                    'media_model_type_model_id_index' => ['model_type', 'model_id'],
                    'media_order_column_index' => ['order_column'],
                    'IDX_885DBAFAA76ED395' => ['user_id'],
                },
            );

            return;
        }

        if ($connection === 'pgsql') {
            expect($index->columns)->toEqual(
                match ($index->name) {
                    "{$table}_pkey" => ['id'],
                    'users_email_unique' => ['email'],
                    'posts_slug_unique' => ['slug'],
                    'posts_name_index' => ['name'],
                    'media_uuid_unique' => ['uuid'],
                    'media_model_type_model_id_index' => ['model_type', 'model_id'],
                    'media_order_column_index' => ['order_column'],
                    'IDX_885DBAFAA76ED395' => ['user_id'],
                },
            );

            return;
        }

        expect($index->columns)->toEqual(
            match ($index->name) {
                'PRIMARY' => ['id'],
                'users_email_unique' => ['email'],
                'posts_user_id_foreign' => ['user_id'],
                'posts_slug_unique' => ['slug'],
                'posts_name_index' => ['name'],
                'custom_fulltext_index_name' => ['yolo'],
                'media_uuid_unique' => ['uuid'],
                'media_model_type_model_id_index' => ['model_type', 'model_id'],
                'media_order_column_index' => ['order_column'],
            },
        );
    });
})->with('tables', 'connections');

it('Index::$flags', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index): void {
        expect($index->flags)->toEqual($index->name === 'custom_fulltext_index_name' ? ['fulltext'] : []);
    });
})->with('tables', 'connections');

it('Index::$options', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index) use ($connection): void {
        if ($connection !== 'mysql' && $index->name === 'IDX_885DBAFAA76ED395') {
            expect($index->options)->toEqual([]);

            return;
        }

        expect($index->options)->toEqual(['lengths' => array_map(fn () => null, $index->columns)]);
    });
})->with('tables', 'connections');

it('Index::$compound', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index): void {
        expect($index->compound)->toEqual(count($index->columns) > 1);
    });
})->with('tables', 'connections');

it('Index::$primaryOrUnique', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index): void {
        expect($index->primaryOrUnique)->toEqual($index->primary || $index->unique);
    });
})->with('tables', 'connections');

it('Index::$primaryAndUnique', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index): void {
        expect($index->primaryAndUnique)->toEqual($index->primary && $index->unique);
    });
})->with('tables', 'connections');

it('Index::schema()', function (string $table, string $connection): void {
    $indexes = Inspect::indexes($table, $connection);

    $indexes->each(static function (Index $index): void {
        expect($index->schema() instanceof IndexSchema)->toEqual(true);
    });
})->with('tables', 'connections');
