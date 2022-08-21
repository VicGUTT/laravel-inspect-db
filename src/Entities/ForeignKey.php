<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Entities;

use Doctrine\DBAL\Schema\ForeignKeyConstraint as ForeignKeySchema;

class ForeignKey extends Entity
{
    /**
     * The foreign key name.
     */
    public readonly string $name;

    /**
     * The name of the table where the foreign key constraint is set.
     */
    public readonly string $localTableName;

    /**
     * On the table where the foreign key constraint is set,
     * the column names which constitutes the foreign key constraint.
     *
     * @var string[]
     */
    public readonly array $localColumnNames;

    /**
     * The name of the table the foreign key constraint is targeting.
     */
    public readonly string $foreignTableName;

    // /**
    //  * The non-schema qualified foreign table name (non-namespaced).
    //  */
    // public readonly string $unqualifiedForeignTableName;

    /**
     * On the table the foreign key constraint is targeting,
     * the column names targeted by the foreign key constraint.
     *
     * @var string[]
     */
    public readonly array $foreignColumnNames;

    /**
     * The options associated with the foreign key constraint.
     */
    public readonly array $options;

    /**
     * The operation that will be performed on the local table when an `UPDATE`
     * action occurs on foreign table rows targeted by the foreign key.
     *
     * Possible values: `CASCADE`, `RESTRICT`.
     */
    public readonly null|string $onUpdate;

    /**
     * The operation that will be performed on the local table when a `DELETE`
     * action occurs on foreign table rows targeted by the foreign key.
     *
     * Possible values: `CASCADE`, `RESTRICT`, `SET NULL`.
     */
    public readonly null|string $onDelete;

    /**
     * The underlying Doctrine\DBAL schema asset.
     */
    protected ForeignKeySchema $schema;

    public function __construct(ForeignKeySchema $schema)
    {
        $this->schema = $schema;

        $this->name = $schema->getName();
        $this->localTableName = $schema->getLocalTableName(); // @phpstan-ignore-line
        $this->localColumnNames = $schema->getLocalColumns();
        $this->foreignTableName = $schema->getForeignTableName();
        // $this->unqualifiedForeignTableName = $schema->getUnqualifiedForeignTableName();
        $this->foreignColumnNames = $schema->getForeignColumns();
        $this->options = $schema->getOptions();
        $this->onUpdate = $schema->onUpdate();
        $this->onDelete = $schema->onDelete();
    }

    /**
     * Named constructor. Creates a new ForeignKey instance.
     */
    public static function make(ForeignKeySchema $schema): self
    {
        return new self($schema);
    }

    /**
     * Return the underlying Doctrine\DBAL schema asset.
     */
    public function schema(): ForeignKeySchema
    {
        return $this->schema;
    }
}
