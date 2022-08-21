<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Collections\Entities;

use VicGutt\InspectDb\Entities\ForeignKey;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Schema\ForeignKeyConstraint as ForeignKeySchema;

/**
 * @extends EntityCollection<string, \VicGutt\InspectDb\Entities\ForeignKey>
 */
class ForeignKeyCollection extends EntityCollection
{
    /**
     * Create a new collection.
     *
     * @param  null|Arrayable<array-key, ForeignKeySchema|ForeignKey>|iterable<array-key, ForeignKeySchema|ForeignKey>  $items
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * Converts items into Entities.
     *
     * @param  array<array-key, ForeignKeySchema|ForeignKey>  $items
     * @return ForeignKey[]
     */
    protected function arrayableItemsToEntities(array $items): array
    {
        return array_reduce($items, function (array $acc, ForeignKeySchema|ForeignKey $item): array {
            if (!($item instanceof ForeignKey)) {
                $item = ForeignKey::make($item);
            }

            $acc[$item->name] = $item;

            return $acc;
        }, []);
    }
}
