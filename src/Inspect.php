<?php

declare(strict_types=1);

namespace VicGutt\InspectDb;

use Illuminate\Database\Connection;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Entities\Table;
use VicGutt\InspectDb\Entities\Column;
use Illuminate\Support\Traits\Macroable;
use VicGutt\InspectDb\Entities\ForeignKey;
use Doctrine\DBAL\Schema\Table as TableSchema;
use Doctrine\DBAL\Platforms\AbstractPlatform as Platform;
use Doctrine\DBAL\Schema\AbstractSchemaManager as Schema;
use VicGutt\InspectDb\Collections\Entities\IndexCollection;
use VicGutt\InspectDb\Collections\Entities\TableCollection;
use VicGutt\InspectDb\Collections\Entities\ColumnCollection;
use VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection;

class Inspect
{
    use Macroable;

    // public static function database(null|string|Connection $connection = null): Database
    // {
    //     return Database::make(Db::connection($connection));
    // }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function tables(null|string|Connection|Schema $schema = null): TableCollection
    {
        return TableCollection::make(Db::tables($schema));
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function table(string|TableSchema $name, null|string|Connection|Schema $schema = null): Table
    {
        return Table::make(Db::table($name, $schema));
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function columns(string|TableSchema $table, null|string|Connection|Schema $schema = null): ColumnCollection
    {
        return self::table($table, $schema)->columns;
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function indexes(string|TableSchema $table, null|string|Connection|Schema $schema = null): IndexCollection
    {
        return self::table($table, $schema)->indexes;
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function foreignKeys(string|TableSchema $table, null|string|Connection|Schema $schema = null): ForeignKeyCollection
    {
        return self::table($table, $schema)->foreignKeys;
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function column(string $name, string|TableSchema $table, null|string|Connection|Schema $schema = null): ?Column
    {
        return self::columns($table, $schema)->get($name);
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function index(string $name, string|TableSchema $table, null|string|Connection|Schema $schema = null): ?Index
    {
        return self::indexes($table, $schema)->get($name);
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function foreignKey(string $name, string|TableSchema $table, null|string|Connection|Schema $schema = null): ?ForeignKey
    {
        return self::foreignKeys($table, $schema)->get($name);
    }
}
