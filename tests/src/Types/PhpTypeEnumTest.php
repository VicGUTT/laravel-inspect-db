<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\DateTimeType;
use VicGutt\InspectDb\Types\PhpTypeEnum;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;
use VicGutt\InspectDb\Contracts\Types\TypeEnumContract;

it('implements `VicGutt\InspectDb\Contracts\Types\TypeEnumContract`', function (): void {
    expect(is_subclass_of(PhpTypeEnum::class, TypeEnumContract::class))->toEqual(true);
});

it('PhpTypeEnum::values()', function (): void {
    expect(PhpTypeEnum::values())->toEqual([
        'null',
        'bool',
        'int',
        'float',
        'string',
        'array',
        'object',
        'resource',
        'unknown',
    ]);
});

it('PhpTypeEnum::fromString()', function (): void {
    expect(PhpTypeEnum::fromString('null'))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromString('bool'))->toEqual(PhpTypeEnum::BOOL);
    expect(PhpTypeEnum::fromString('int'))->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::fromString('float'))->toEqual(PhpTypeEnum::FLOAT);
    expect(PhpTypeEnum::fromString('string'))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromString('array'))->toEqual(PhpTypeEnum::ARRAY);
    expect(PhpTypeEnum::fromString('object'))->toEqual(PhpTypeEnum::OBJECT);
    expect(PhpTypeEnum::fromString('resource'))->toEqual(PhpTypeEnum::RESOURCE);
    expect(PhpTypeEnum::fromString('unknown'))->toEqual(PhpTypeEnum::UNKNOWN);

    expect(PhpTypeEnum::fromString('undefined'))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromString('number'))->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::fromString('symbol'))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromString('bigint'))->toEqual(PhpTypeEnum::STRING);

    foreach ([Types::STRING, Types::DECIMAL, Types::ASCII_STRING, Types::BIGINT, Types::TEXT, Types::GUID] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::STRING);
    }

    foreach ([Types::INTEGER, Types::SMALLINT] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::INT);
    }

    foreach ([Types::FLOAT] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::FLOAT);
    }

    foreach ([Types::BOOLEAN] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::BOOL);
    }

    foreach ([Types::BINARY, Types::BLOB] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::RESOURCE);
    }

    // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
    foreach ([Types::OBJECT] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::OBJECT);
    }

    // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
    foreach ([Types::ARRAY, Types::SIMPLE_ARRAY, Types::JSON] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::ARRAY);
    }

    foreach ([
        Types::DATE_MUTABLE, Types::DATE_IMMUTABLE, Types::DATEINTERVAL, Types::DATETIME_MUTABLE,
        Types::DATETIME_IMMUTABLE, Types::DATETIMETZ_MUTABLE, Types::DATETIMETZ_IMMUTABLE,
        Types::TIME_MUTABLE, Types::TIME_IMMUTABLE,
    ] as $type) {
        expect(PhpTypeEnum::fromString($type))->toEqual(PhpTypeEnum::STRING);
    }
});

it('PhpTypeEnum::fromDoctrineType()', function (): void {
    expect(PhpTypeEnum::fromDoctrineType(new BigIntType()))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromDoctrineType(new DateTimeType()))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromDoctrineType(new JsonType()))->toEqual(PhpTypeEnum::ARRAY);
});

it('PhpTypeEnum::fromPhp()', function (): void {
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::NULL))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::FLOAT))->toEqual(PhpTypeEnum::FLOAT);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::ARRAY))->toEqual(PhpTypeEnum::ARRAY);
});

it('PhpTypeEnum::fromJavascript()', function (): void {
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::NULL))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::NUMBER))->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::OBJECT))->toEqual(PhpTypeEnum::OBJECT);
});

it('PhpTypeEnum::toPhp()', function (): void {
    expect(PhpTypeEnum::NULL->toPhp())->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::INT->toPhp())->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::OBJECT->toPhp())->toEqual(PhpTypeEnum::OBJECT);
});

it('PhpTypeEnum::toJavascript()', function (): void {
    expect(PhpTypeEnum::NULL->toJavascript())->toEqual(JavaScriptTypeEnum::NULL);
    expect(PhpTypeEnum::INT->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(PhpTypeEnum::OBJECT->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT);
});

it('PhpTypeEnum::raw()', function (): void {
    expect(PhpTypeEnum::NULL->raw())->toEqual('null');
    expect(PhpTypeEnum::INT->raw())->toEqual('int');
    expect(PhpTypeEnum::OBJECT->raw())->toEqual('object');
    expect(PhpTypeEnum::UNKNOWN->raw())->toEqual(null);
});
