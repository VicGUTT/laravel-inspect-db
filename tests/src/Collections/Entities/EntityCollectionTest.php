<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use VicGutt\InspectDb\Collections\Entities\EntityCollection;

it('extends `Illuminate\Support\Collection`', function (): void {
    expect(is_subclass_of(EntityCollection::class, Collection::class))->toEqual(true);
});
