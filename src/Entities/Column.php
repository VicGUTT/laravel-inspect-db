<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Entities;

use VicGutt\InspectDb\Types\Type;
use Doctrine\DBAL\Schema\Column as ColumnSchema;
use VicGutt\InspectDb\Concerns\Entities\Helpers;

class Column extends Entity
{
    use Helpers;

    /**
     * The column name.
     */
    public readonly string $name;

    /**
     * The table defined collation if any.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $collation;

    /**
     * The table defined charset if any.
     *
     * @phpstan-ignore-next-line -> This property IS assigned in the constructor
     */
    public readonly null|string $charset;

    /**
     * The column type.
     */
    public readonly Type $type;

    /**
     * The column length if any.
     */
    public readonly null|int $length;

    /**
     * The column precision.
     */
    public readonly int $precision;

    /**
     * The column scale.
     */
    public readonly int $scale;

    /**
     * Whether the column is unsigned or not.
     */
    public readonly bool $unsigned;

    /**
     * Whether the column is fixed or not.
     */
    public readonly bool $fixed;

    /**
     * Determines whether the column accepts `null` values or not.
     */
    public readonly bool $nullable;

    /**
     * The column's defined default value if any.
     */
    public readonly mixed $default;

    /**
     * The column platformOptions.
     */
    public readonly array $platformOptions;

    /**
     * The column columnDefinition if any.
     */
    public readonly null|string $columnDefinition;

    /**
     * Whether the column autoincrements or not.
     */
    public readonly bool $autoincrement;

    /**
     * The column's defined comment if any.
     */
    public readonly null|string $comment;

    /**
     * The underlying Doctrine\DBAL schema asset.
     */
    protected ColumnSchema $schema;

    public function __construct(ColumnSchema $schema)
    {
        $this->schema = $schema;

        $this->setProperties($schema->getPlatformOptions(), ['collation' => null, 'charset' => null]);

        $this->name = $schema->getName();
        $this->type = Type::fromDoctrineType($schema->getType());
        $this->length = $schema->getLength();
        $this->precision = $schema->getPrecision();
        $this->scale = $schema->getScale();
        $this->unsigned = $schema->getUnsigned();
        $this->fixed = $schema->getFixed();
        $this->nullable = !$schema->getNotnull();
        $this->default = $schema->getDefault();
        $this->platformOptions = $schema->getPlatformOptions();
        $this->columnDefinition = $schema->getColumnDefinition();
        $this->autoincrement = $schema->getAutoincrement();
        $this->comment = $schema->getComment();
    }

    /**
     * Named constructor. Creates a new Column instance.
     */
    public static function make(ColumnSchema $schema): self
    {
        return new self($schema);
    }

    /**
     * Return the underlying Doctrine\DBAL schema asset.
     */
    public function schema(): ColumnSchema
    {
        return $this->schema;
    }
}
