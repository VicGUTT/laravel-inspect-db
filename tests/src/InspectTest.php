<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use VicGutt\InspectDb\Inspect;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Entities\Table;
use VicGutt\InspectDb\Entities\Column;
use Illuminate\Support\Traits\Macroable;
use VicGutt\InspectDb\Entities\ForeignKey;
use VicGutt\InspectDb\Collections\Entities\IndexCollection;
use VicGutt\InspectDb\Collections\Entities\TableCollection;
use VicGutt\InspectDb\Collections\Entities\ColumnCollection;
use VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection;

/* Misc.
------------------------------------------------*/

it('uses `Illuminate\Support\Traits\Macroable`', function (): void {
    expect(in_array(Macroable::class, class_uses(Inspect::class), true))->toEqual(true);
});

/* Inspect::tables
------------------------------------------------*/

it('Inspect::tables | $schema = null', function (): void {
    expect(Inspect::tables() instanceof TableCollection)->toEqual(true);
});

it('Inspect::tables | $schema = string', function (string $connection): void {
    expect(Inspect::tables($connection) instanceof TableCollection)->toEqual(true);
})->with('connections');

it('Inspect::tables | $schema = Connection', function (string $connection): void {
    expect(Inspect::tables(Db::connection($connection)) instanceof TableCollection)->toEqual(true);
})->with('connections');

it('Inspect::tables | $schema = Schema', function (string $connection): void {
    expect(Inspect::tables(Db::schema($connection)) instanceof TableCollection)->toEqual(true);
})->with('connections');

/* Inspect::table
------------------------------------------------*/

it('Inspect::table | $schema = null', function (): void {
    expect(Inspect::table('users') instanceof Table)->toEqual(true);
    expect(Inspect::table(Db::table('users')) instanceof Table)->toEqual(true);
});

it('Inspect::table | $schema = string', function (string $connection): void {
    expect(Inspect::table('users', $connection) instanceof Table)->toEqual(true);
    expect(Inspect::table(Db::table('users', $connection), $connection) instanceof Table)->toEqual(true);
})->with('connections');

it('Inspect::table | $schema = Connection', function (string $connection): void {
    expect(Inspect::table('users', Db::connection($connection)) instanceof Table)->toEqual(true);
    expect(Inspect::table(Db::table('users', $connection), Db::connection($connection)) instanceof Table)->toEqual(true);
})->with('connections');

it('Inspect::table | $schema = Schema', function (string $connection): void {
    expect(Inspect::table('users', Db::schema($connection)) instanceof Table)->toEqual(true);
    expect(Inspect::table(Db::table('users', $connection), Db::schema($connection)) instanceof Table)->toEqual(true);
})->with('connections');

it('Inspect::table | Still works even when given an unknown table', function (): void {
    expect(Inspect::table('nope') instanceof Table)->toEqual(true);
    expect(Inspect::table(Db::table('nope')) instanceof Table)->toEqual(true);
});

/* Inspect::columns
------------------------------------------------*/

it('Inspect::columns | $schema = null', function (): void {
    expect(Inspect::columns('users') instanceof ColumnCollection)->toEqual(true);
    expect(Inspect::columns(Db::table('users')) instanceof ColumnCollection)->toEqual(true);
});

it('Inspect::columns | $schema = string', function (string $connection): void {
    expect(Inspect::columns('users', $connection) instanceof ColumnCollection)->toEqual(true);
    expect(Inspect::columns(Db::table('users', $connection), $connection) instanceof ColumnCollection)->toEqual(true);
})->with('connections');

it('Inspect::columns | $schema = Connection', function (string $connection): void {
    expect(Inspect::columns('users', Db::connection($connection)) instanceof ColumnCollection)->toEqual(true);
    expect(Inspect::columns(Db::table('users', $connection), Db::connection($connection)) instanceof ColumnCollection)->toEqual(true);
})->with('connections');

it('Inspect::columns | $schema = Schema', function (string $connection): void {
    expect(Inspect::columns('users', Db::schema($connection)) instanceof ColumnCollection)->toEqual(true);
    expect(Inspect::columns(Db::table('users', $connection), Db::schema($connection)) instanceof ColumnCollection)->toEqual(true);
})->with('connections');

it('Inspect::columns | Still works even when given an unknown table', function (): void {
    expect(Inspect::columns('users')->isEmpty())->toEqual(false);
    expect(Inspect::columns('nope')->isEmpty())->toEqual(true);
    expect(Inspect::columns(Db::table('nope'))->isEmpty())->toEqual(true);
});

/* Inspect::indexes
------------------------------------------------*/

it('Inspect::indexes | $schema = null', function (): void {
    expect(Inspect::indexes('users') instanceof IndexCollection)->toEqual(true);
    expect(Inspect::indexes(Db::table('users')) instanceof IndexCollection)->toEqual(true);
});

it('Inspect::indexes | $schema = string', function (string $connection): void {
    expect(Inspect::indexes('users', $connection) instanceof IndexCollection)->toEqual(true);
    expect(Inspect::indexes(Db::table('users', $connection), $connection) instanceof IndexCollection)->toEqual(true);
})->with('connections');

it('Inspect::indexes | $schema = Connection', function (string $connection): void {
    expect(Inspect::indexes('users', Db::connection($connection)) instanceof IndexCollection)->toEqual(true);
    expect(Inspect::indexes(Db::table('users', $connection), Db::connection($connection)) instanceof IndexCollection)->toEqual(true);
})->with('connections');

it('Inspect::indexes | $schema = Schema', function (string $connection): void {
    expect(Inspect::indexes('users', Db::schema($connection)) instanceof IndexCollection)->toEqual(true);
    expect(Inspect::indexes(Db::table('users', $connection), Db::schema($connection)) instanceof IndexCollection)->toEqual(true);
})->with('connections');

it('Inspect::indexes | Still works even when given an unknown table', function (): void {
    expect(Inspect::indexes('users')->isEmpty())->toEqual(false);
    expect(Inspect::indexes('nope')->isEmpty())->toEqual(true);
    expect(Inspect::indexes(Db::table('nope'))->isEmpty())->toEqual(true);
});

/* Inspect::foreignKeys
------------------------------------------------*/

it('Inspect::foreignKeys | $schema = null', function (): void {
    expect(Inspect::foreignKeys('posts') instanceof ForeignKeyCollection)->toEqual(true);
    expect(Inspect::foreignKeys(Db::table('posts')) instanceof ForeignKeyCollection)->toEqual(true);
});

it('Inspect::foreignKeys | $schema = string', function (string $connection): void {
    expect(Inspect::foreignKeys('posts', $connection) instanceof ForeignKeyCollection)->toEqual(true);
    expect(Inspect::foreignKeys(Db::table('posts', $connection), $connection) instanceof ForeignKeyCollection)->toEqual(true);
})->with('connections');

it('Inspect::foreignKeys | $schema = Connection', function (string $connection): void {
    expect(Inspect::foreignKeys('posts', Db::connection($connection)) instanceof ForeignKeyCollection)->toEqual(true);
    expect(Inspect::foreignKeys(Db::table('posts', $connection), Db::connection($connection)) instanceof ForeignKeyCollection)->toEqual(true);
})->with('connections');

it('Inspect::foreignKeys | $schema = Schema', function (string $connection): void {
    expect(Inspect::foreignKeys('posts', Db::schema($connection)) instanceof ForeignKeyCollection)->toEqual(true);
    expect(Inspect::foreignKeys(Db::table('posts', $connection), Db::schema($connection)) instanceof ForeignKeyCollection)->toEqual(true);
})->with('connections');

it('Inspect::foreignKeys | Still works even when given an unknown table', function (): void {
    expect(Inspect::foreignKeys('posts')->isEmpty())->toEqual(false);
    expect(Inspect::foreignKeys('nope')->isEmpty())->toEqual(true);
    expect(Inspect::foreignKeys(Db::table('nope'))->isEmpty())->toEqual(true);
});

/* Inspect::column
------------------------------------------------*/

it('Inspect::column | $schema = null', function (): void {
    expect(Inspect::column('id', 'users') instanceof Column)->toEqual(true);
    expect(Inspect::column('id', Db::table('users')) instanceof Column)->toEqual(true);
});

it('Inspect::column | $schema = string', function (string $connection): void {
    expect(Inspect::column('id', 'users', $connection) instanceof Column)->toEqual(true);
    expect(Inspect::column('id', Db::table('users', $connection), $connection) instanceof Column)->toEqual(true);
})->with('connections');

it('Inspect::column | $schema = Connection', function (string $connection): void {
    expect(Inspect::column('id', 'users', Db::connection($connection)) instanceof Column)->toEqual(true);
    expect(Inspect::column('id', Db::table('users', $connection), Db::connection($connection)) instanceof Column)->toEqual(true);
})->with('connections');

it('Inspect::column | $schema = Schema', function (string $connection): void {
    expect(Inspect::column('id', 'users', Db::schema($connection)) instanceof Column)->toEqual(true);
    expect(Inspect::column('id', Db::table('users', $connection), Db::schema($connection)) instanceof Column)->toEqual(true);
})->with('connections');

it('Inspect::column | Returns null when given an unknown table', function (): void {
    expect(Inspect::column('id', 'nope'))->toEqual(null);
});

it('Inspect::column | Returns null when given an unknown column', function (): void {
    expect(Inspect::column('nope', 'nope'))->toEqual(null);
});

/* Inspect::index
------------------------------------------------*/

it('Inspect::index | $schema = null', function (): void {
    expect(Inspect::index('PRIMARY', 'users') instanceof Index)->toEqual(true);
    expect(Inspect::index('PRIMARY', Db::table('users')) instanceof Index)->toEqual(true);
});

it('Inspect::index | $schema = string', function (string $connection): void {
    $key = match ($connection) {
        'sqlite' => 'primary',
        'mysql' => 'PRIMARY',
        'pgsql' => 'users_pkey',
    };

    expect(Inspect::index($key, 'users', $connection) instanceof Index)->toEqual(true);
    expect(Inspect::index($key, Db::table('users', $connection), $connection) instanceof Index)->toEqual(true);
})->with('connections');

it('Inspect::index | $schema = Connection', function (string $connection): void {
    $key = match ($connection) {
        'sqlite' => 'primary',
        'mysql' => 'PRIMARY',
        'pgsql' => 'users_pkey',
    };

    expect(Inspect::index($key, 'users', Db::connection($connection)) instanceof Index)->toEqual(true);
    expect(Inspect::index($key, Db::table('users', $connection), Db::connection($connection)) instanceof Index)->toEqual(true);
})->with('connections');

it('Inspect::index | $schema = Schema', function (string $connection): void {
    $key = match ($connection) {
        'sqlite' => 'primary',
        'mysql' => 'PRIMARY',
        'pgsql' => 'users_pkey',
    };

    expect(Inspect::index($key, 'users', Db::schema($connection)) instanceof Index)->toEqual(true);
    expect(Inspect::index($key, Db::table('users', $connection), Db::schema($connection)) instanceof Index)->toEqual(true);
})->with('connections');

it('Inspect::index | Returns null when given an unknown table', function (): void {
    expect(Inspect::index('PRIMARY', 'nope'))->toEqual(null);
});

it('Inspect::index | Returns null when given an unknown index', function (): void {
    expect(Inspect::index('nope', 'nope'))->toEqual(null);
});

/* Inspect::foreignKey
------------------------------------------------*/

it('Inspect::foreignKey | $schema = null', function (): void {
    expect(Inspect::foreignKey('posts_user_id_foreign', 'posts') instanceof ForeignKey)->toEqual(true);
    expect(Inspect::foreignKey('posts_user_id_foreign', Db::table('posts')) instanceof ForeignKey)->toEqual(true);
});

it('Inspect::foreignKey | $schema = string', function (string $connection): void {
    if ($connection === 'sqlite') {
        /**
         * SQlite does not have a mechanism to retrieve the constraint name ?
         */
        expect(Inspect::foreignKey('', 'posts', $connection) instanceof ForeignKey)->toEqual(true);
        expect(Inspect::foreignKey('', Db::table('posts', $connection), $connection) instanceof ForeignKey)->toEqual(true);

        return;
    }

    expect(Inspect::foreignKey('posts_user_id_foreign', 'posts', $connection) instanceof ForeignKey)->toEqual(true);
    expect(Inspect::foreignKey('posts_user_id_foreign', Db::table('posts', $connection), $connection) instanceof ForeignKey)->toEqual(true);
})->with('connections');

it('Inspect::foreignKey | $schema = Connection', function (string $connection): void {
    if ($connection === 'sqlite') {
        /**
         * SQlite does not have a mechanism to retrieve the constraint name ?
         */
        expect(Inspect::foreignKey('', 'posts', Db::connection($connection)) instanceof ForeignKey)->toEqual(true);
        expect(Inspect::foreignKey('', Db::table('posts', $connection), Db::connection($connection)) instanceof ForeignKey)->toEqual(true);

        return;
    }

    expect(Inspect::foreignKey('posts_user_id_foreign', 'posts', Db::connection($connection)) instanceof ForeignKey)->toEqual(true);
    expect(Inspect::foreignKey('posts_user_id_foreign', Db::table('posts', $connection), Db::connection($connection)) instanceof ForeignKey)->toEqual(true);
})->with('connections');

it('Inspect::foreignKey | $schema = Schema', function (string $connection): void {
    if ($connection === 'sqlite') {
        /**
         * SQlite does not have a mechanism to retrieve the constraint name ?
         */
        expect(Inspect::foreignKey('', 'posts', Db::schema($connection)) instanceof ForeignKey)->toEqual(true);
        expect(Inspect::foreignKey('', Db::table('posts', $connection), Db::schema($connection)) instanceof ForeignKey)->toEqual(true);

        return;
    }

    expect(Inspect::foreignKey('posts_user_id_foreign', 'posts', Db::schema($connection)) instanceof ForeignKey)->toEqual(true);
    expect(Inspect::foreignKey('posts_user_id_foreign', Db::table('posts', $connection), Db::schema($connection)) instanceof ForeignKey)->toEqual(true);
})->with('connections');

it('Inspect::foreignKey | Returns null when given an unknown table', function (): void {
    expect(Inspect::foreignKey('posts_user_id_foreign', 'nope'))->toEqual(null);
});

it('Inspect::foreignKey | Returns null when given an unknown foreignKey', function (): void {
    expect(Inspect::foreignKey('nope', 'nope'))->toEqual(null);
});
