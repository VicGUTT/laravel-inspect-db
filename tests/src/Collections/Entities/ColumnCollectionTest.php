<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use VicGutt\InspectDb\Entities\Column;
use VicGutt\InspectDb\Collections\Entities\ColumnCollection;
use VicGutt\InspectDb\Collections\Entities\EntityCollection;

it('extends `VicGutt\InspectDb\Collections\Entities\EntityCollection`', function (): void {
    expect(is_subclass_of(ColumnCollection::class, EntityCollection::class))->toEqual(true);
});

it('only accepts `ColumnSchema|Column` to be passed in as as collection items', function (): void {
    expect(fn () => ColumnCollection::make(['nope']))->toThrow(TypeError::class, 'Argument #2 ($item) must be of type Doctrine\DBAL\Schema\Column|VicGutt\InspectDb\Entities\Column, string given');
});

it('only `Column` are set as collection items', function (): void {
    $columns = Db::table('posts')->getColumns();
    $columns = ColumnCollection::make($columns);

    expect($columns->isNotEmpty())->toEqual(true);

    $columns->each(function (Column $column, string $name): void {
        expect($column instanceof Column)->toEqual(true);
        expect(is_string($name))->toEqual(true);
    });
});

it('returns an array when `toArray()` is called', function (): void {
    $columns = Db::table('posts')->getColumns();
    $columns = ColumnCollection::make($columns)->toArray();

    expect(is_array($columns))->toEqual(true);
    expect(!empty($columns))->toEqual(true);

    foreach ($columns as $key => $value) {
        expect(is_string($key))->toEqual(true);
        expect(!is_object($value))->toEqual(true);
    }
});
