<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use VicGutt\InspectDb\Entities\Index;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Schema\Index as IndexSchema;

/**
 * @extends EntityCollection<string, \VicGutt\InspectDb\Entities\Index>
 */
class IndexCollection extends EntityCollection
{
    /**
     * Create a new collection.
     *
     * @param  null|Arrayable<array-key, IndexSchema|Index>|iterable<array-key, IndexSchema|Index>  $items
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * Converts items into Entities.
     *
     * @param  array<array-key, IndexSchema|Index>  $items
     * @return Index[]
     */
    protected function arrayableItemsToEntities(array $items): array
    {
        return array_reduce($items, function (array $acc, IndexSchema|Index $item): array {
            if (!($item instanceof Index)) {
                $item = Index::make($item);
            }

            $acc[$item->name] = $item;

            return $acc;
        }, []);
    }
}
