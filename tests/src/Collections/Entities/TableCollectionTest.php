<?php

declare(strict_types=1);

use VicGutt\InspectDb\Db;
use VicGutt\InspectDb\Entities\Table;
use VicGutt\InspectDb\Collections\Entities\TableCollection;
use VicGutt\InspectDb\Collections\Entities\EntityCollection;

it('extends `VicGutt\InspectDb\Collections\Entities\EntityCollection`', function (): void {
    expect(is_subclass_of(TableCollection::class, EntityCollection::class))->toEqual(true);
});

it('only accepts `TableSchema|Table` to be passed in as as collection items', function (): void {
    expect(static fn () => TableCollection::make(['nope']))->toThrow(
        TypeError::class,
        'Argument #2 ($item) must be of type Doctrine\DBAL\Schema\Table|VicGutt\InspectDb\Entities\Table, string given',
    );
});

it('only `Table` are set as collection items', function (): void {
    $tables = TableCollection::make(Db::tables());

    expect($tables->isNotEmpty())->toEqual(true);

    $tables->each(function (Table $table, string $name): void {
        expect($table instanceof Table)->toEqual(true);
        expect(is_string($name))->toEqual(true);
    });
});

it('returns an array when `toArray()` is called', function (): void {
    $tables = TableCollection::make(Db::tables())->toArray();

    expect(is_array($tables))->toEqual(true);
    expect(!empty($tables))->toEqual(true);

    foreach ($tables as $key => $value) {
        expect(is_string($key))->toEqual(true);
        expect(!is_object($value))->toEqual(true);
    }
});
