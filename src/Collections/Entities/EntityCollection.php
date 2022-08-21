<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use Illuminate\Support\Collection;
use VicGutt\InspectDb\Entities\Entity;

/**
 * @template TKey of array-key
 * @template TValue of \VicGutt\InspectDb\Entities\Entity
 *
 * @extends Collection<string, TValue>
 */
abstract class EntityCollection extends Collection
{
    /**
     * Create a new collection.
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
        return array_map(fn (Entity $item): array => $item->toArray(), $this->items);
    }
}
