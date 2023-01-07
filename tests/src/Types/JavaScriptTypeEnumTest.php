<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\BinaryType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\SmallIntType;
use Doctrine\DBAL\Types\DateTimeTzType;
use Doctrine\DBAL\Types\AsciiStringType;
use Doctrine\DBAL\Types\SimpleArrayType;
use VicGutt\InspectDb\Types\PhpTypeEnum;
use Doctrine\DBAL\Types\DateIntervalType;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\DBAL\Types\TimeImmutableType;
use VicGutt\InspectDb\Types\DoctrineTypeEnum;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
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

it('PhpTypeEnum::fromDoctrine()', function (): void {
    expect(JavaScriptTypeEnum::fromDoctrine(new AsciiStringType()))->toEqual(DoctrineTypeEnum::ASCII_STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new BigIntType()))->toEqual(DoctrineTypeEnum::BIGINT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new BinaryType()))->toEqual(DoctrineTypeEnum::BINARY->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new BlobType()))->toEqual(DoctrineTypeEnum::BLOB->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new BooleanType()))->toEqual(DoctrineTypeEnum::BOOLEAN->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateType()))->toEqual(DoctrineTypeEnum::DATE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateImmutableType()))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateIntervalType()))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateTimeType()))->toEqual(DoctrineTypeEnum::DATETIME->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateTimeImmutableType()))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateTimeTzType()))->toEqual(DoctrineTypeEnum::DATETIMETZ->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DateTimeTzImmutableType()))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new DecimalType()))->toEqual(DoctrineTypeEnum::DECIMAL->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new FloatType()))->toEqual(DoctrineTypeEnum::FLOAT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new GuidType()))->toEqual(DoctrineTypeEnum::GUID->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new IntegerType()))->toEqual(DoctrineTypeEnum::INTEGER->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new JsonType()))->toEqual(DoctrineTypeEnum::JSON->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new SimpleArrayType()))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new SmallIntType()))->toEqual(DoctrineTypeEnum::SMALLINT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new StringType()))->toEqual(DoctrineTypeEnum::STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new TextType()))->toEqual(DoctrineTypeEnum::TEXT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new TimeType()))->toEqual(DoctrineTypeEnum::TIME->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(new TimeImmutableType()))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toJavascript());

    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::BINARY))->toEqual(DoctrineTypeEnum::BINARY->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::BLOB))->toEqual(DoctrineTypeEnum::BLOB->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE))->toEqual(DoctrineTypeEnum::DATE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME))->toEqual(DoctrineTypeEnum::DATETIME->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ))->toEqual(DoctrineTypeEnum::DATETIMETZ->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::GUID))->toEqual(DoctrineTypeEnum::GUID->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::JSON))->toEqual(DoctrineTypeEnum::JSON->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::STRING))->toEqual(DoctrineTypeEnum::STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::TEXT))->toEqual(DoctrineTypeEnum::TEXT->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME))->toEqual(DoctrineTypeEnum::TIME->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromDoctrine(DoctrineTypeEnum::UNKNOWN))->toEqual(DoctrineTypeEnum::UNKNOWN->toJavascript());
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
    expect(JavaScriptTypeEnum::fromString(' '))->toEqual(JavaScriptTypeEnum::UNKNOWN);
    expect(JavaScriptTypeEnum::fromString(''))->toEqual(JavaScriptTypeEnum::UNKNOWN);

    expect(JavaScriptTypeEnum::fromString(Types::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::BINARY))->toEqual(DoctrineTypeEnum::BINARY->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::BLOB))->toEqual(DoctrineTypeEnum::BLOB->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATE_MUTABLE))->toEqual(DoctrineTypeEnum::DATE->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATETIME_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIME->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATETIMETZ_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::GUID))->toEqual(DoctrineTypeEnum::GUID->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::JSON))->toEqual(DoctrineTypeEnum::JSON->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::STRING))->toEqual(DoctrineTypeEnum::STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::TEXT))->toEqual(DoctrineTypeEnum::TEXT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::TIME_MUTABLE))->toEqual(DoctrineTypeEnum::TIME->toJavascript());
    expect(JavaScriptTypeEnum::fromString(Types::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toJavascript());

    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::NULL->value))->toEqual(PhpTypeEnum::NULL->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::BOOL->value))->toEqual(PhpTypeEnum::BOOL->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::INT->value))->toEqual(PhpTypeEnum::INT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::FLOAT->value))->toEqual(PhpTypeEnum::FLOAT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::STRING->value))->toEqual(PhpTypeEnum::STRING->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::ARRAY->value))->toEqual(PhpTypeEnum::ARRAY->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::OBJECT->value))->toEqual(PhpTypeEnum::OBJECT->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::RESOURCE->value))->toEqual(PhpTypeEnum::RESOURCE->toJavascript());
    expect(JavaScriptTypeEnum::fromString(PhpTypeEnum::UNKNOWN->value))->toEqual(PhpTypeEnum::UNKNOWN->toJavascript());
});

it('JavaScriptTypeEnum::fromPhp()', function (): void {
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::NULL))->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::BOOL))->toEqual(JavaScriptTypeEnum::BOOLEAN);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::INT))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::FLOAT))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::STRING))->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::ARRAY))->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::OBJECT))->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::RESOURCE))->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::fromPhp(PhpTypeEnum::UNKNOWN))->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::fromJavascript()', function (): void {
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::NULL))->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::UNDEFINED))->toEqual(JavaScriptTypeEnum::UNDEFINED);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::BOOLEAN))->toEqual(JavaScriptTypeEnum::BOOLEAN);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::NUMBER))->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::STRING))->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::SYMBOL))->toEqual(JavaScriptTypeEnum::SYMBOL);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::BIGINT))->toEqual(JavaScriptTypeEnum::BIGINT);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::OBJECT))->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::fromJavascript(JavaScriptTypeEnum::UNKNOWN))->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::toPhp()', function (): void {
    expect(JavaScriptTypeEnum::NULL->toPhp())->toEqual(PhpTypeEnum::NULL);
    expect(JavaScriptTypeEnum::UNDEFINED->toPhp())->toEqual(PhpTypeEnum::NULL);
    expect(JavaScriptTypeEnum::BOOLEAN->toPhp())->toEqual(PhpTypeEnum::BOOL);
    expect(JavaScriptTypeEnum::NUMBER->toPhp())->toEqual(PhpTypeEnum::FLOAT);
    expect(JavaScriptTypeEnum::STRING->toPhp())->toEqual(PhpTypeEnum::STRING);
    expect(JavaScriptTypeEnum::SYMBOL->toPhp())->toEqual(PhpTypeEnum::STRING);
    expect(JavaScriptTypeEnum::BIGINT->toPhp())->toEqual(PhpTypeEnum::STRING);
    expect(JavaScriptTypeEnum::OBJECT->toPhp())->toEqual(PhpTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::UNKNOWN->toPhp())->toEqual(PhpTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::toJavascript()', function (): void {
    expect(JavaScriptTypeEnum::NULL->toJavascript())->toEqual(JavaScriptTypeEnum::NULL);
    expect(JavaScriptTypeEnum::UNDEFINED->toJavascript())->toEqual(JavaScriptTypeEnum::UNDEFINED);
    expect(JavaScriptTypeEnum::BOOLEAN->toJavascript())->toEqual(JavaScriptTypeEnum::BOOLEAN);
    expect(JavaScriptTypeEnum::NUMBER->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(JavaScriptTypeEnum::STRING->toJavascript())->toEqual(JavaScriptTypeEnum::STRING);
    expect(JavaScriptTypeEnum::SYMBOL->toJavascript())->toEqual(JavaScriptTypeEnum::SYMBOL);
    expect(JavaScriptTypeEnum::BIGINT->toJavascript())->toEqual(JavaScriptTypeEnum::BIGINT);
    expect(JavaScriptTypeEnum::OBJECT->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(JavaScriptTypeEnum::UNKNOWN->toJavascript())->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('JavaScriptTypeEnum::raw()', function (): void {
    expect(JavaScriptTypeEnum::NULL->raw())->toEqual('null');
    expect(JavaScriptTypeEnum::NUMBER->raw())->toEqual('number');
    expect(JavaScriptTypeEnum::OBJECT->raw())->toEqual('object');
    expect(JavaScriptTypeEnum::UNKNOWN->raw())->toEqual(null);
});
