<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\DateTimeType;
use VicGutt\InspectDb\Types\PhpTypeEnum;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;
use VicGutt\InspectDb\Contracts\Types\TypeEnumContract;

it('implements `VicGutt\InspectDb\Contracts\Types\TypeEnumContract`', function (): void {
    expect(is_subclass_of(JavaScriptTypeEnum::class, TypeEnumContract::class))->toEqual(true);
});

it('JavaScriptTypeEnum::values()', function (): void {
    expect(JavaScriptTypeEnum::values())->toEqual([
        'null',
        'undefined',
        'boolean',
        'number',
        'string',
        'symbol',
        'bigint',
        'object',
        'unknown',
    ]);
});

it('JavaScriptTypeEnum::fromString()', function (): void {
    expect(JavaScriptTypeEnum::fromString('null'))->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::fromString('undefined'))->toEqual(JavaScriptTypeEnum::UNDEFINED);
    expect(JavaScriptTypeEnum::fromString('boolean'))->toEqual(JavaScriptTypeEnum::BOOLEAN);
    expect(JavaScriptTypeEnum::fromString('number'))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromString('string'))->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::fromString('symbol'))->toEqual(JavaScriptTypeEnum::SYMBOL);
    expect(JavaScriptTypeEnum::fromString('bigint'))->toEqual(JavaScriptTypeEnum::BIGINT);
    expect(JavaScriptTypeEnum::fromString('object'))->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::fromString('unknown'))->toEqual(JavaScriptTypeEnum::UNKNOWN);
    expect(JavaScriptTypeEnum::fromString('nope'))->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::fromDoctrineType()', function (): void {
    expect(JavaScriptTypeEnum::fromDoctrineType(new BigIntType()))->toEqual(JavaScriptTypeEnum::BIGINT);
    expect(JavaScriptTypeEnum::fromDoctrineType(new DateTimeType()))->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::fromDoctrineType(new JsonType()))->toEqual(JavaScriptTypeEnum::OBJECT);
});

it('JavaScriptTypeEnum::fromPhp()', function (): void {
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::NULL))->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::FLOAT))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::ARRAY))->toEqual(JavaScriptTypeEnum::OBJECT);
});

it('JavaScriptTypeEnum::fromJavascript()', function (): void {
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::NULL))->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::NUMBER))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::OBJECT))->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::UNKNOWN))->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::toPhp()', function (): void {
    expect(JavaScriptTypeEnum::NULL->toPhp())->toEqual(PhpTypeEnum::NULL);
    expect(JavaScriptTypeEnum::NUMBER->toPhp())->toEqual(PhpTypeEnum::INT);
    expect(JavaScriptTypeEnum::OBJECT->toPhp())->toEqual(PhpTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::UNKNOWN->toPhp())->toEqual(PhpTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::toJavascript()', function (): void {
    expect(JavaScriptTypeEnum::NULL->toJavascript())->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::NUMBER->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::OBJECT->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::UNKNOWN->toJavascript())->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::raw()', function (): void {
    expect(JavaScriptTypeEnum::NULL->raw())->toEqual('null');
    expect(JavaScriptTypeEnum::NUMBER->raw())->toEqual('number');
    expect(JavaScriptTypeEnum::OBJECT->raw())->toEqual('object');
    expect(JavaScriptTypeEnum::UNKNOWN->raw())->toEqual(null);
});
