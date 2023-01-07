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

it('PhpTypeEnum::fromDoctrine()', function (): void {
    expect(PhpTypeEnum::fromDoctrine(new AsciiStringType()))->toEqual(DoctrineTypeEnum::ASCII_STRING->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new BigIntType()))->toEqual(DoctrineTypeEnum::BIGINT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new BinaryType()))->toEqual(DoctrineTypeEnum::BINARY->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new BlobType()))->toEqual(DoctrineTypeEnum::BLOB->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new BooleanType()))->toEqual(DoctrineTypeEnum::BOOLEAN->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateType()))->toEqual(DoctrineTypeEnum::DATE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateImmutableType()))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateIntervalType()))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateTimeType()))->toEqual(DoctrineTypeEnum::DATETIME->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateTimeImmutableType()))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateTimeTzType()))->toEqual(DoctrineTypeEnum::DATETIMETZ->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DateTimeTzImmutableType()))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new DecimalType()))->toEqual(DoctrineTypeEnum::DECIMAL->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new FloatType()))->toEqual(DoctrineTypeEnum::FLOAT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new GuidType()))->toEqual(DoctrineTypeEnum::GUID->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new IntegerType()))->toEqual(DoctrineTypeEnum::INTEGER->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new JsonType()))->toEqual(DoctrineTypeEnum::JSON->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new SimpleArrayType()))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new SmallIntType()))->toEqual(DoctrineTypeEnum::SMALLINT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new StringType()))->toEqual(DoctrineTypeEnum::STRING->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new TextType()))->toEqual(DoctrineTypeEnum::TEXT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new TimeType()))->toEqual(DoctrineTypeEnum::TIME->toPhp());
    expect(PhpTypeEnum::fromDoctrine(new TimeImmutableType()))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toPhp());

    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::BINARY))->toEqual(DoctrineTypeEnum::BINARY->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::BLOB))->toEqual(DoctrineTypeEnum::BLOB->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE))->toEqual(DoctrineTypeEnum::DATE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME))->toEqual(DoctrineTypeEnum::DATETIME->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ))->toEqual(DoctrineTypeEnum::DATETIMETZ->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::GUID))->toEqual(DoctrineTypeEnum::GUID->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::JSON))->toEqual(DoctrineTypeEnum::JSON->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::STRING))->toEqual(DoctrineTypeEnum::STRING->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::TEXT))->toEqual(DoctrineTypeEnum::TEXT->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME))->toEqual(DoctrineTypeEnum::TIME->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromDoctrine(DoctrineTypeEnum::UNKNOWN))->toEqual(DoctrineTypeEnum::UNKNOWN->toPhp());
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

    expect(PhpTypeEnum::fromString('nope'))->toEqual(PhpTypeEnum::UNKNOWN);
    expect(PhpTypeEnum::fromString(' '))->toEqual(PhpTypeEnum::UNKNOWN);
    expect(PhpTypeEnum::fromString(''))->toEqual(PhpTypeEnum::UNKNOWN);

    expect(PhpTypeEnum::fromString(Types::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING->toPhp());
    expect(PhpTypeEnum::fromString(Types::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT->toPhp());
    expect(PhpTypeEnum::fromString(Types::BINARY))->toEqual(DoctrineTypeEnum::BINARY->toPhp());
    expect(PhpTypeEnum::fromString(Types::BLOB))->toEqual(DoctrineTypeEnum::BLOB->toPhp());
    expect(PhpTypeEnum::fromString(Types::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATE_MUTABLE))->toEqual(DoctrineTypeEnum::DATE->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATETIME_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIME->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATETIMETZ_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ->toPhp());
    expect(PhpTypeEnum::fromString(Types::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->toPhp());
    expect(PhpTypeEnum::fromString(Types::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL->toPhp());
    expect(PhpTypeEnum::fromString(Types::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT->toPhp());
    expect(PhpTypeEnum::fromString(Types::GUID))->toEqual(DoctrineTypeEnum::GUID->toPhp());
    expect(PhpTypeEnum::fromString(Types::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER->toPhp());
    expect(PhpTypeEnum::fromString(Types::JSON))->toEqual(DoctrineTypeEnum::JSON->toPhp());
    expect(PhpTypeEnum::fromString(Types::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->toPhp());
    expect(PhpTypeEnum::fromString(Types::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT->toPhp());
    expect(PhpTypeEnum::fromString(Types::STRING))->toEqual(DoctrineTypeEnum::STRING->toPhp());
    expect(PhpTypeEnum::fromString(Types::TEXT))->toEqual(DoctrineTypeEnum::TEXT->toPhp());
    expect(PhpTypeEnum::fromString(Types::TIME_MUTABLE))->toEqual(DoctrineTypeEnum::TIME->toPhp());
    expect(PhpTypeEnum::fromString(Types::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->toPhp());

    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::NULL->value))->toEqual(JavaScriptTypeEnum::NULL->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::UNDEFINED->value))->toEqual(JavaScriptTypeEnum::UNDEFINED->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::BOOLEAN->value))->toEqual(JavaScriptTypeEnum::BOOLEAN->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::NUMBER->value))->toEqual(JavaScriptTypeEnum::NUMBER->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::STRING->value))->toEqual(JavaScriptTypeEnum::STRING->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::SYMBOL->value))->toEqual(JavaScriptTypeEnum::SYMBOL->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::BIGINT->value))->toEqual(JavaScriptTypeEnum::BIGINT->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::OBJECT->value))->toEqual(JavaScriptTypeEnum::OBJECT->toPhp());
    expect(PhpTypeEnum::fromString(JavaScriptTypeEnum::UNKNOWN->value))->toEqual(JavaScriptTypeEnum::UNKNOWN->toPhp());
});

it('PhpTypeEnum::fromPhp()', function (): void {
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::NULL))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::BOOL))->toEqual(PhpTypeEnum::BOOL);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::INT))->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::FLOAT))->toEqual(PhpTypeEnum::FLOAT);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::STRING))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::ARRAY))->toEqual(PhpTypeEnum::ARRAY);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::OBJECT))->toEqual(PhpTypeEnum::OBJECT);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::RESOURCE))->toEqual(PhpTypeEnum::RESOURCE);
    expect(PhpTypeEnum::fromPhp(PhpTypeEnum::UNKNOWN))->toEqual(PhpTypeEnum::UNKNOWN);
});

it('PhpTypeEnum::fromJavascript()', function (): void {
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::NULL))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::UNDEFINED))->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::BOOLEAN))->toEqual(PhpTypeEnum::BOOL);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::NUMBER))->toEqual(PhpTypeEnum::FLOAT);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::STRING))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::SYMBOL))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::BIGINT))->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::OBJECT))->toEqual(PhpTypeEnum::OBJECT);
    expect(PhpTypeEnum::fromJavascript(JavaScriptTypeEnum::UNKNOWN))->toEqual(PhpTypeEnum::UNKNOWN);
});

it('PhpTypeEnum::toPhp()', function (): void {
    expect(PhpTypeEnum::NULL->toPhp())->toEqual(PhpTypeEnum::NULL);
    expect(PhpTypeEnum::BOOL->toPhp())->toEqual(PhpTypeEnum::BOOL);
    expect(PhpTypeEnum::INT->toPhp())->toEqual(PhpTypeEnum::INT);
    expect(PhpTypeEnum::FLOAT->toPhp())->toEqual(PhpTypeEnum::FLOAT);
    expect(PhpTypeEnum::STRING->toPhp())->toEqual(PhpTypeEnum::STRING);
    expect(PhpTypeEnum::ARRAY->toPhp())->toEqual(PhpTypeEnum::ARRAY);
    expect(PhpTypeEnum::OBJECT->toPhp())->toEqual(PhpTypeEnum::OBJECT);
    expect(PhpTypeEnum::RESOURCE->toPhp())->toEqual(PhpTypeEnum::RESOURCE);
    expect(PhpTypeEnum::UNKNOWN->toPhp())->toEqual(PhpTypeEnum::UNKNOWN);
});

it('PhpTypeEnum::toJavascript()', function (): void {
    expect(PhpTypeEnum::NULL->toJavascript())->toEqual(JavaScriptTypeEnum::NULL);
    expect(PhpTypeEnum::BOOL->toJavascript())->toEqual(JavaScriptTypeEnum::BOOLEAN);
    expect(PhpTypeEnum::INT->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(PhpTypeEnum::FLOAT->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER);
    expect(PhpTypeEnum::STRING->toJavascript())->toEqual(JavaScriptTypeEnum::STRING);
    expect(PhpTypeEnum::ARRAY->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(PhpTypeEnum::OBJECT->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT);
    expect(PhpTypeEnum::RESOURCE->toJavascript())->toEqual(JavaScriptTypeEnum::STRING);
    expect(PhpTypeEnum::UNKNOWN->toJavascript())->toEqual(JavaScriptTypeEnum::UNKNOWN);
});

it('PhpTypeEnum::raw()', function (PhpTypeEnum $type): void {
    expect($type->raw())->toEqual($type->value === PhpTypeEnum::UNKNOWN->value ? null : $type->value);
})->with(PhpTypeEnum::cases());
