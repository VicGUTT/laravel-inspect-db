<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use VicGutt\InspectDb\Entities\Index;
use VicGutt\InspectDb\Collections\Entities\IndexCollection;
use VicGutt\InspectDb\Collections\Entities\EntityCollection;

it('extends `VicGutt\InspectDb\Collections\Entities\EntityCollection`', function (): void {
    expect(is_subclass_of(IndexCollection::class, EntityCollection::class))->toEqual(true);
});

it('only accepts `IndexSchema|Index` to be passed in as as collection items', function (): void {
    expect(fn () => IndexCollection::make(['nope']))->toThrow(TypeError::class, 'Argument #2 ($item) must be of type Doctrine\DBAL\Schema\Index|VicGutt\InspectDb\Entities\Index, string given');
});

it('only `Index` are set as collection items', function (): void {
    $indexes = Db::table('posts')->getIndexes();
    $indexes = IndexCollection::make($indexes);

    expect($indexes->isNotEmpty())->toEqual(true);

    $indexes->each(function (Index $index, string $name): void {
        expect($index instanceof Index)->toEqual(true);
        expect(is_string($name))->toEqual(true);
    });
});

it('returns an array when `toArray()` is called', function (): void {
    $indexes = Db::table('posts')->getIndexes();
    $indexes = IndexCollection::make($indexes)->toArray();

    expect(is_array($indexes))->toEqual(true);
    expect(!empty($indexes))->toEqual(true);

    foreach ($indexes as $key => $value) {
        expect(is_string($key))->toEqual(true);
        expect(!is_object($value))->toEqual(true);
    }
});
