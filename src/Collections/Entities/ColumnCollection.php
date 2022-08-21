<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use VicGutt\InspectDb\Entities\Column;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Schema\Column as ColumnSchema;

/**
 * @extends EntityCollection<string, \VicGutt\InspectDb\Entities\Column>
 */
class ColumnCollection extends EntityCollection
{
    /**
     * Create a new collection.
     *
     * @param  null|Arrayable<array-key, ColumnSchema|Column>|iterable<array-key, ColumnSchema|Column>  $items
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * Converts items into Entities.
     *
     * @param  array<array-key, ColumnSchema|Column>  $items
     * @return Column[]
     */
    protected function arrayableItemsToEntities(array $items): array
    {
        return array_reduce($items, function (array $acc, ColumnSchema|Column $item): array {
            if (!($item instanceof Column)) {
                $item = Column::make($item);
            }

            $acc[$item->name] = $item;

            return $acc;
        }, []);
    }
}
