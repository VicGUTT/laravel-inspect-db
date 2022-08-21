<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Entities;

use Doctrine\DBAL\Schema\Table as TableSchema;
use VicGutt\InspectDb\Concerns\Entities\Helpers;
use VicGutt\InspectDb\Collections\Entities\IndexCollection;
use VicGutt\InspectDb\Collections\Entities\ColumnCollection;
use VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection;

class Table extends Entity
{
    use Helpers;

    /**
     * The table name.
     */
    public readonly string $name;

    /**
     * The table defined engine.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $engine;

    /**
     * The table defined collation.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $collation;

    /**
     * The table defined charset.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $charset;

    /**
     * The table's autoincrement if any.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|int $autoincrement;

    /**
     * The table defined comment.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $comment;

    /**
     * The table's primary key if any.
     */
    public readonly null|Index $primaryKey;

    /**
     * Returns ordered list of columns (primary keys are first, then foreign keys, then the rest).
     */
    public readonly ColumnCollection $columns;

    /**
     * The table indexes.
     */
    public readonly IndexCollection $indexes;

    /**
     * The table foreign keys.
     */
    public readonly ForeignKeyCollection $foreignKeys;

    /**
     * The underlying Doctrine\DBAL schema asset.
     */
    protected TableSchema $schema;

    public function __construct(TableSchema $schema)
    {
        $this->schema = $schema;

        $this->setPropertiesFromOptions();
        $this->setPrimaryKey();

        $this->name = $schema->getName();
        $this->columns = ColumnCollection::make($schema->getColumns());
        $this->indexes = IndexCollection::make($schema->getIndexes());
        $this->foreignKeys = ForeignKeyCollection::make($schema->getForeignKeys());
    }

    /**
     * Named constructor. Creates a new Table instance.
     */
    public static function make(TableSchema $schema): self
    {
        return new self($schema);
    }

    /**
     * Return the underlying Doctrine\DBAL schema asset.
     */
    public function schema(): TableSchema
    {
        return $this->schema;
    }

    /**
     * Returns the table primary key columns.
     */
    public function primaryKeyColumns(): ColumnCollection
    {
        return ColumnCollection::make($this->schema->getPrimaryKeyColumns());
    }

    /**
     * Returns the table foreign key columns.
     */
    public function foreignKeyColumns(): ColumnCollection
    {
        return ColumnCollection::make($this->schema->getForeignKeyColumns());
    }

    protected function setPropertiesFromOptions(): void
    {
        $this->setProperties($this->schema->getOptions(), [
            'engine' => null,
            'collation' => null,
            'charset' => null,
            'autoincrement' => null,
            'comment' => null,
        ]);
    }

    protected function setPrimaryKey(): void
    {
        $primaryKey = $this->schema->getPrimaryKey();

        if ($primaryKey) {
            $primaryKey = Index::make($primaryKey);
        }

        // @phpstan-ignore-next-line
        $this->primaryKey = $primaryKey;
    }
}
