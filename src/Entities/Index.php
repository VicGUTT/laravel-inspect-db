<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Entities;

use Doctrine\DBAL\Schema\Index as IndexSchema;

class Index extends Entity
{
    /**
     * The index name.
     */
    public readonly string $name;

    /**
     * Whether or not the index is a primary index.
     */
    public readonly bool $primary;

    /**
     * Whether or not the index is a unique index.
     */
    public readonly bool $unique;

    /**
     * The column names constituting the index.
     *
     * @var string[]
     */
    public readonly array $columns;

    /**
     * The platform specific flags for indexes.
     *
     * @var string[]
     */
    public readonly array $flags;

    /**
     * The index options.
     */
    public readonly array $options;

    /**
     * Whether or not the index is a "compound" (or composite, or multiple-column)
     * index, meaning, an index composed of multiple columns.
     */
    public readonly bool $compound;

    /**
     * Whether the index a `primary` index **OR** a `unique` index.
     */
    public readonly bool $primaryOrUnique;

    /**
     * Whether the index a `primary` index **AND** a `unique` index.
     */
    public readonly bool $primaryAndUnique;

    /**
     * The underlying Doctrine\DBAL schema asset.
     */
    protected IndexSchema $schema;

    public function __construct(IndexSchema $schema)
    {
        $this->schema = $schema;

        $this->name = $schema->getName();
        $this->primary = $schema->isPrimary();
        $this->unique = $schema->isUnique();
        $this->columns = $schema->getColumns();
        $this->flags = $schema->getFlags();
        $this->options = $schema->getOptions();
        $this->compound = count($this->columns) > 1;
        $this->primaryOrUnique = !$schema->isSimpleIndex();
        $this->primaryAndUnique = $this->primary && $this->unique;
    }

    /**
     * Named constructor. Creates a new Index instance.
     */
    public static function make(IndexSchema $schema): self
    {
        return new self($schema);
    }

    /**
     * Return the underlying Doctrine\DBAL schema asset.
     */
    public function schema(): IndexSchema
    {
        return $this->schema;
    }
}
