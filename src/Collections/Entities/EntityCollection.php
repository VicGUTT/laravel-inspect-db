<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use Illuminate\Support\Collection;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Entities\Table;
use VicGutt\InspectDb\Entities\Column;
use VicGutt\InspectDb\Entities\Entity;
use Doctrine\DBAL\Schema\AbstractAsset;
use VicGutt\InspectDb\Entities\ForeignKey;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Schema\Index as IndexSchema;
use Doctrine\DBAL\Schema\Table as TableSchema;
use Doctrine\DBAL\Schema\Column as ColumnSchema;
use Doctrine\DBAL\Schema\ForeignKeyConstraint as ForeignKeySchema;

/**
 * @template TKey of array-key
 * @template TValue of Entity
 *
 * @extends Collection<string, TValue>
 */
abstract class EntityCollection extends Collection
{
    /**
     * Create a new collection.
     *
     * @param  null|Arrayable<array-key, AbstractAsset|Entity>|iterable<array-key, AbstractAsset|Entity>|Arrayable<array-key, ColumnSchema|Column>|iterable<array-key, ColumnSchema|Column>|Arrayable<array-key, ForeignKeySchema|ForeignKey>|iterable<array-key, ForeignKeySchema|ForeignKey>|Arrayable<array-key, IndexSchema|Index>|iterable<array-key, IndexSchema|Index>|Arrayable<array-key, TableSchema|Table>|iterable<array-key, TableSchema|Table>  $items
     * @return void
     */
    public function __construct($items = [])
    {
        $this->items = $this->arrayableItemsToEntities($this->getArrayableItems($items));
    }

    /**
     * Converts items into Entities.
     *
     * @param  array<array-key, mixed>  $items
     * @return array<TKey, TValue>
     */
    abstract protected function arrayableItemsToEntities(array $items): array;

    /**
     * Get the collection of items as a plain array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_map(static fn (Entity $item): array => $item->toArray(), $this->items);
    }
}
