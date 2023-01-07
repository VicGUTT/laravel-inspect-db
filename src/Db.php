<?php

declare(strict_types=1);

namespace VicGutt\InspectDb;

use Illuminate\Database\Connection;
use Doctrine\DBAL\Schema\Table as TableSchema;
use Illuminate\Support\Facades\DB as DbFacade;
use Doctrine\DBAL\Platforms\AbstractPlatform as Platform;
use Doctrine\DBAL\Schema\AbstractSchemaManager as Schema;

class Db
{
    /**
     * Retrieve a database connection.
     */
    public static function connection(null|string|Connection $connection = null): Connection
    {
        if ($connection instanceof Connection) {
            return $connection;
        }

        return DbFacade::connection($connection);
    }

    /**
     * Retrieve the Doctrine Schema Manager of a given
     * database connection.
     *
     * @return Schema<Platform>
     */
    public static function schema(null|string|Connection $connection = null): Schema
    {
        return self::connection($connection)->getDoctrineSchemaManager();
    }

    /**
     * Retrieve the tables of a given database connection.
     *
     * @param null|string|Connection|Schema<Platform> $schema
     * @return TableSchema[]
     */
    public static function tables(null|string|Connection|Schema $schema = null): array
    {
        return self::getSchema($schema)->listTables();
    }

    /**
     * Retrieve a particular table for a given database connection.
     *
     * @param null|string|Connection|Schema<Platform> $schema
     */
    public static function table(string|TableSchema $name, null|string|Connection|Schema $schema = null): TableSchema
    {
        if ($name instanceof TableSchema) {
            return $name;
        }

        return self::getSchema($schema)->listTableDetails($name);
    }

    /**
     * @param null|string|Connection|Schema<Platform> $schema
     * @return Schema<Platform>
     */
    protected static function getSchema(null|string|Connection|Schema $schema = null): Schema
    {
        if (!($schema instanceof Schema)) {
            $schema = self::schema($schema);
        }

        return $schema;
    }
}
