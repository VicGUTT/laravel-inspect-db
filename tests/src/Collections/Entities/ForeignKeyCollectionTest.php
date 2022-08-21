<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use VicGutt\InspectDb\Entities\ForeignKey;
use VicGutt\InspectDb\Collections\Entities\EntityCollection;
use VicGutt\InspectDb\Collections\Entities\ForeignKeyCollection;

it('extends `VicGutt\InspectDb\Collections\Entities\EntityCollection`', function (): void {
    expect(is_subclass_of(ForeignKeyCollection::class, EntityCollection::class))->toEqual(true);
});

it('only accepts `ForeignKeySchema|ForeignKey` to be passed in as as collection items', function (): void {
    expect(fn () => ForeignKeyCollection::make(['nope']))->toThrow(TypeError::class, 'Argument #2 ($item) must be of type Doctrine\DBAL\Schema\ForeignKeyConstraint|VicGutt\InspectDb\Entities\ForeignKey, string given');
});

it('only `ForeignKey` are set as collection items', function (): void {
    $foreignKeys = Db::table('posts')->getForeignKeys();
    $foreignKeys = ForeignKeyCollection::make($foreignKeys);

    expect($foreignKeys->isNotEmpty())->toEqual(true);

    $foreignKeys->each(function (ForeignKey $foreignKey, string $name): void {
        expect($foreignKey instanceof ForeignKey)->toEqual(true);
        expect(is_string($name))->toEqual(true);
    });
});

it('returns an array when `toArray()` is called', function (): void {
    $foreignKeys = Db::table('posts')->getForeignKeys();
    $foreignKeys = ForeignKeyCollection::make($foreignKeys)->toArray();

    expect(is_array($foreignKeys))->toEqual(true);
    expect(!empty($foreignKeys))->toEqual(true);

    foreach ($foreignKeys as $key => $value) {
        expect(is_string($key))->toEqual(true);
        expect(!is_object($value))->toEqual(true);
    }
});
