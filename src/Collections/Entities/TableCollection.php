<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use VicGutt\InspectDb\Entities\Table;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Schema\Table as TableSchema;

/**
 * @extends EntityCollection<string, \VicGutt\InspectDb\Entities\Table>
 */
class TableCollection extends EntityCollection
{
    /**
     * Create a new collection.
     *
     * @param  null|Arrayable<array-key, TableSchema|Table>|iterable<array-key, TableSchema|Table>  $items
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * Converts items into Entities.
     *
     * @param  array<array-key, TableSchema|Table>  $items
     * @return Table[]
     */
    protected function arrayableItemsToEntities(array $items): array
    {
        return array_reduce($items, function (array $acc, TableSchema|Table $item): array {
            if (!($item instanceof Table)) {
                $item = Table::make($item);
            }

            $acc[$item->name] = $item;

            return $acc;
        }, []);
    }
}
