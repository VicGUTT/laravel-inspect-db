# Inspect and retrieve information about a given database

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vicgutt/laravel-inspect-db.svg?style=flat-square)](https://packagist.org/packages/vicgutt/laravel-inspect-db)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vicgutt/laravel-inspect-db/run-tests?label=tests)](https://github.com/vicgutt/laravel-inspect-db/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vicgutt/laravel-inspect-db/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/vicgutt/laravel-inspect-db/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vicgutt/laravel-inspect-db.svg?style=flat-square)](https://packagist.org/packages/vicgutt/laravel-inspect-db)

---

This package allows you to inspect and retrieve information about your databases. This package has been tested against Sqlite, MySQL and PostgreSQL although others might work as well, if not, let's discuss it.

Here's a quick example:

```php
use VicGutt\InspectDb\Inspect;

// On a default Laravel "users" table, running:
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

## Inspect

The `VicGutt\InspectDb\Inspect` class is the main entry point of the package. It allows you to retrieve information about tables, a table's columns, it's indexes and foreign keys.

---

### TODO:
- Finish README
- Setup GitHub action test workflow

---

<!-- ### Retrieving a database connection's tables

To retrieve all tables of a given database connection, call the `tables` static method:

```php
...
``` -->

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
