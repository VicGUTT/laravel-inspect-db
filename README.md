# Inspect and retrieve information about a given database

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vicgutt/laravel-inspect-db.svg?style=flat-square)](https://packagist.org/packages/vicgutt/laravel-inspect-db)

<!-- [![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vicgutt/laravel-inspect-db/run-tests?label=tests)](https://github.com/vicgutt/laravel-inspect-db/actions?query=workflow%3Arun-tests+branch%3Amain) -->
<!-- [![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vicgutt/laravel-inspect-db/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/vicgutt/laravel-inspect-db/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain) -->

[![Total Downloads](https://img.shields.io/packagist/dt/vicgutt/laravel-inspect-db.svg?style=flat-square)](https://packagist.org/packages/vicgutt/laravel-inspect-db)

---

This package allows you to inspect and retrieve information about your databases. This package has been tested against Sqlite, MySQL and PostgreSQL although others might work as well, if not, let's discuss it.

Here's a quick example:

```php
use VicGutt\InspectDb\Inspect;

// On a default Laravel "users" table using the "mysql" connection, running:
Inspect::table($name = 'users', $connectionOrSchemaManagerOrNull = 'mysql')->toArray();

// would return the following:
[
    'name' => 'users',
    'engine' => 'InnoDB',
    'collation' => 'utf8mb4_unicode_ci',
    'charset' => 'utf8mb4',
    'autoincrement' => 1,
    'comment' => '',
    'primaryKey' => [
        'name' => 'PRIMARY',
        'primary' => true,
        'unique' => true,
        // ...
    ],
    'columns' => [
        'id' => [/* ... */],
        'name' => [/* ... */],
        'email' => [/* ... */],
        // ...
    ],
    'indexes' => [/* ... */],
    'foreignKeys' => [],
]
```

## Installation

You can install the package via composer:

```bash
composer require vicgutt/laravel-inspect-db
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-inspect-db-config"
```

You can check out what the contents of the published config file will be here: [config/inspect-db.php](/config/inspect-db.php)

## Inspect

The `VicGutt\InspectDb\Inspect` class is the main entry point of the package. It allows you to retrieve information about tables, a table's columns, it's indexes and foreign keys.

### Retrieving the tables of a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Collections\Entities\TableCollection`
Inspect::tables();
```

Here, as no database connection was specified, the default configured database connection will be used.

### Retrieving a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Entities\Table`
Inspect::table('users');
```

Here, as no database connection was specified as second argument, the default configured database connection will be used.

### Retrieving the columns of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Collections\Entities\ColumnCollection`
Inspect::columns('users');
```

Here, as no database connection was specified as second argument, the default configured database connection will be used.

### Retrieving the indexes of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Collections\Entities\IndexCollection`
Inspect::indexes('users');
```

Here, as no database connection was specified as second argument, the default configured database connection will be used.

### Retrieving the foreign keys of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection`
Inspect::foreignKeys('users');
```

Here, as no database connection was specified as second argument, the default configured database connection will be used.

### Retrieving a particular column of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Entities\Column` or null
Inspect::column('id', 'users');
```

Here, as no database connection was specified as third argument, the default configured database connection will be used.

### Retrieving a particular index of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Entities\Index` or null
Inspect::index('PRIMARY', 'users');
```

Here, as no database connection was specified as third argument, the default configured database connection will be used.

### Retrieving a particular foreign key of a particular table for a given database connection

```php
use VicGutt\InspectDb\Inspect;

// returns an instance of `VicGutt\InspectDb\Entities\ForeignKey` or null
Inspect::foreignKey('posts_user_id_foreign', 'posts');
```

Here, as no database connection was specified as third argument, the default configured database connection will be used.

## Collections

The collections provided by this package all extend the abstract `VicGutt\InspectDb\Collections\Entities\EntityCollection` class which itself extends from the default Laravel collection _(`Illuminate\Support\Collection`)_.

The available collections are:

-   VicGutt\InspectDb\Collections\Entities\\`TableCollection`
-   VicGutt\InspectDb\Collections\Entities\\`ColumnCollection`
-   VicGutt\InspectDb\Collections\Entities\\`IndexCollection`
-   VicGutt\InspectDb\Collections\Entities\\`ForeignKeyCollection`

The above collections differ slightly from the default Laravel collection and behavior you might be used to. That is, our collections internal items can only ever be an array of the entities they represent. As an example, the `TableCollection` items can only ever be an array of `Table`s.

In usage, this translates to type errors being thrown when some collection methods are used:

```php
/**
 * The following will throw a `TypeError` with a message specifying the "$item" given
 * is a string rather than instances of `Doctrine\DBAL\Schema\Table` or `VicGutt\InspectDb\Entities\Table`.
 */
Inspect::tables()->map(fn (Table $table): string => $table->name);
Inspect::tables()->pluck('name');
```

The solution to this is to convert our Collection into a default Laravel collection prior to calling methods which returns new instances of the current collection but with mutated items:

```php
/**
 * Now, all is well.
 */
Inspect::tables()->toBase()->map(fn (Table $table): string => $table->name);
Inspect::tables()->toBase()->pluck('name');
```

This behavior, although admittedly surprising, helps guarantee a collection of Xs only ever actually contains Xs.

## Entities

Entities are meant to represent units present in a given database.

<!-- or the database itself (--\> for when we can do Inspect::database(...)) -->

The available entities are:

-   [VicGutt\InspectDb\Entities\\`Table`](/src/Entities/Table.php)
-   [VicGutt\InspectDb\Entities\\`Column`](/src/Entities/Column.php)
-   [VicGutt\InspectDb\Entities\\`Index`](/src/Entities/Index.php)
-   [VicGutt\InspectDb\Entities\\`ForeignKey`](/src/Entities/ForeignKey.php)

Click on any of the listed entities above to learn more about the exposed properties and methods.

---

### TODO:

-   Setup GitHub action test workflow

---

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

If you're interested in contributing to the project, please read our [contributing docs](https://github.com/vicgutt/laravel-inspect-db/blob/main/.github/CONTRIBUTING.md) **before submitting a pull request**.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Victor GUTT](https://github.com/vicgutt)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
