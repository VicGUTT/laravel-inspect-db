<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use VicGutt\InspectDb\Inspect;
use VicGutt\InspectDb\Types\Type;
use VicGutt\InspectDb\Entities\Column;
use VicGutt\InspectDb\Entities\Entity;

it('extends `VicGutt\InspectDb\Entities\Entity`', function (): void {
    expect(is_subclass_of(Column::class, Entity::class))->toEqual(true);
});

it('Column::$name', function (string $table, string $connection): void {
    $cols = [
        'users' => [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
        ],
        'posts' => [
            'id',
            'name',
            'img',
            'slug',
            'content',
            'reading_time',
            'yolo',
            'excerpt',
            'validated',
            'draft',
            'published_at',
            'draft_updated_at',
            'user_id',
            'created_at',
            'updated_at',
        ],
        'media' => [
            'id',
            'model_id',
            'model_type',
            'uuid',
            'collection_name',
            'name',
            'file_name',
            'mime_type',
            'disk',
            'conversions_disk',
            'size',
            'manipulations',
            'custom_properties',
            'generated_conversions',
            'responsive_images',
            'order_column',
            'created_at',
            'updated_at',
        ],
    ];

    $columns = Inspect::columns($table, $connection);
    $cols = $cols[$table];

    $columns->each(static function (Column $column) use ($cols): void {
        expect(in_array($column->name, $cols, true))->toEqual(true);
    });

    foreach ($cols as $col) {
        expect($columns->get($col)->name)->toEqual($col);
    }
})->with('tables', 'connections');

it('Column::$collation', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($column->name === 'yolo') {
            expect($column->collation)->toEqual(
                match ($connection) {
                    'sqlite' => 'BINARY',
                    'mysql' => 'latin1_swedish_ci',
                    'pgsql' => 'und',
                },
            );

            return;
        }

        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        if (in_array($column->schema()->getType()->getName(), [Types::STRING, Types::TEXT], true)) {
            expect($column->collation)->toEqual(
                match ($connection) {
                    'sqlite' => 'BINARY',
                    'mysql' => 'utf8mb4_unicode_ci',
                    'pgsql' => null,
                },
            );

            return;
        }

        expect($column->collation)->toEqual(null);
    });
})->with('tables', 'connections');

it('Column::$charset', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($column->name === 'yolo') {
            expect($column->charset)->toEqual(
                match ($connection) {
                    'sqlite' => null,
                    'mysql' => 'latin1',
                    'pgsql' => null,
                },
            );

            return;
        }

        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        if (in_array($column->schema()->getType()->getName(), [Types::STRING, Types::TEXT], true)) {
            expect($column->charset)->toEqual(
                match ($connection) {
                    'sqlite' => null,
                    'mysql' => 'utf8mb4',
                    'pgsql' => null,
                },
            );

            return;
        }

        expect($column->charset)->toEqual(null);
    });
})->with('tables', 'connections');

it('Column::$type', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->type instanceof Type)->toEqual(true);
        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        expect($column->type->value)->toEqual($column->schema()->getType()->getName());
    });
})->with('tables', 'connections');

it('Column::$length', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($connection !== 'sqlite' && $column->name === 'excerpt') {
            expect($column->length)->toEqual(160);

            return;
        }

        if ($connection !== 'sqlite' && $column->type->value === Types::STRING) {
            expect($column->length)->toEqual(
                match ($column->name) {
                    'uuid' => 36,
                    'remember_token' => 100,
                    default => 255,
                },
            );

            return;
        }

        if ($connection === 'mysql' && $column->type->value === Types::TEXT) {
            expect($column->length)->toEqual(65535);

            return;
        }

        if ($connection === 'sqlite' && in_array($column->name, ['validated', 'draft'], true)) {
            expect($column->length)->toEqual(1);

            return;
        }

        expect($column->length)->toEqual(null);
    });
})->with('tables', 'connections');

it('Column::$precision', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->precision)->toEqual(10);
    });
})->with('tables', 'connections');

it('Column::$scale', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->scale)->toEqual(0);
    });
})->with('tables', 'connections');

it('Column::$unsigned', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($connection !== 'mysql') {
            expect($column->unsigned)->toEqual(false);

            return;
        }

        expect($column->unsigned)->toEqual(in_array($column->name, ['id', 'model_id', 'user_id', 'reading_time', 'size', 'order_column'], true));
    });
})->with('tables', 'connections');

it('Column::$fixed', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($connection !== 'mysql') {
            expect($column->unsigned)->toEqual(false);

            return;
        }

        expect($column->fixed)->toEqual($column->name === 'uuid');
    });
})->with('tables', 'connections');

it('Column::$nullable', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->nullable)->toEqual(in_array($column->name, [
            'email_verified_at',
            'yolo',
            'excerpt',
            'uuid',
            'mime_type',
            'conversions_disk',
            'order_column',
            'remember_token',
            'created_at',
            'updated_at',
        ], true));
    });
})->with('tables', 'connections');

it('Column::$default', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->default)->toEqual(
            match ($column->name) {
                'img' => 'fallback.jpg',
                'validated' => 0,
                'draft' => 1,
                'published_at' => 'CURRENT_TIMESTAMP',
                default => null,
            },
        );
    });
})->with('tables', 'connections');

it('Column::$platformOptions', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($column->name === 'yolo') {
            expect($column->platformOptions)->toEqual(
                match ($connection) {
                    'sqlite' => ['collation' => 'BINARY'],
                    'mysql' => ['charset' => 'latin1', 'collation' => 'latin1_swedish_ci'],
                    'pgsql' => ['collation' => 'und'],
                },
            );

            return;
        }

        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        if (in_array($column->schema()->getType()->getName(), [Types::STRING, Types::TEXT], true)) {
            expect($column->platformOptions)->toEqual(
                match ($connection) {
                    'sqlite' => ['collation' => 'BINARY'],
                    'mysql' => ['charset' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci'],
                    'pgsql' => [],
                },
            );

            return;
        }

        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        if ($column->schema()->getType()->getName() === Types::JSON) {
            expect($column->platformOptions)->toEqual(
                match ($connection) {
                    'sqlite' => [],
                    'mysql' => [],
                    'pgsql' => ['jsonb' => null],
                },
            );

            return;
        }

        expect($column->platformOptions)->toEqual([]);
    });
})->with('tables', 'connections');

it('Column::$columnDefinition', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->columnDefinition)->toEqual(null);
    });
})->with('tables', 'connections');

it('Column::$autoincrement', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column): void {
        expect($column->autoincrement)->toEqual($column->name === 'id');
    });
})->with('tables', 'connections');

it('Column::$comment', function (string $table, string $connection): void {
    $columns = Inspect::columns($table, $connection);

    $columns->each(static function (Column $column) use ($connection): void {
        if ($connection === 'sqlite') {
            expect($column->comment)->toEqual(null);

            return;
        }

        expect($column->comment)->toEqual(
            match ($column->name) {
                'reading_time' => 'The amount of time it would take the average human to read the entire article in seconds.',
                'validated' => 'Whether or not the given post has been validated by an admin user.',
                'draft' => 'Whether or not the given post is in "draft" mode.',
                default => null,
            },
        );
    });
})->with('tables', 'connections');
