<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeType;
use VicGutt\InspectDb\Types\Type;
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
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use VicGutt\InspectDb\Types\DoctrineTypeEnum;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;

it('implements `Illuminate\Contracts\Support\Arrayable`', function (): void {
    expect(is_subclass_of(Type::class, Arrayable::class))->toEqual(true);
});

it('implements `Illuminate\Contracts\Support\Jsonable`', function (): void {
    expect(is_subclass_of(Type::class, Jsonable::class))->toEqual(true);
});

it('implements `JsonSerializable`', function (): void {
    expect(is_subclass_of(Type::class, JsonSerializable::class))->toEqual(true);
});

it('implements `Stringable`', function (): void {
    expect(is_subclass_of(Type::class, Stringable::class))->toEqual(true);
});

it('Type::fromDoctrine()', function (): void {
    expect(Type::fromDoctrine(new AsciiStringType())->value)->toEqual(DoctrineTypeEnum::ASCII_STRING->value);
    expect(Type::fromDoctrine(new BigIntType())->value)->toEqual(DoctrineTypeEnum::BIGINT->value);
    expect(Type::fromDoctrine(new BinaryType())->value)->toEqual(DoctrineTypeEnum::BINARY->value);
    expect(Type::fromDoctrine(new BlobType())->value)->toEqual(DoctrineTypeEnum::BLOB->value);
    expect(Type::fromDoctrine(new BooleanType())->value)->toEqual(DoctrineTypeEnum::BOOLEAN->value);
    expect(Type::fromDoctrine(new DateType())->value)->toEqual(DoctrineTypeEnum::DATE->value);
    expect(Type::fromDoctrine(new DateImmutableType())->value)->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->value);
    expect(Type::fromDoctrine(new DateIntervalType())->value)->toEqual(DoctrineTypeEnum::DATEINTERVAL->value);
    expect(Type::fromDoctrine(new DateTimeType())->value)->toEqual(DoctrineTypeEnum::DATETIME->value);
    expect(Type::fromDoctrine(new DateTimeImmutableType())->value)->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->value);
    expect(Type::fromDoctrine(new DateTimeTzType())->value)->toEqual(DoctrineTypeEnum::DATETIMETZ->value);
    expect(Type::fromDoctrine(new DateTimeTzImmutableType())->value)->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value);
    expect(Type::fromDoctrine(new DecimalType())->value)->toEqual(DoctrineTypeEnum::DECIMAL->value);
    expect(Type::fromDoctrine(new FloatType())->value)->toEqual(DoctrineTypeEnum::FLOAT->value);
    expect(Type::fromDoctrine(new GuidType())->value)->toEqual(DoctrineTypeEnum::GUID->value);
    expect(Type::fromDoctrine(new IntegerType())->value)->toEqual(DoctrineTypeEnum::INTEGER->value);
    expect(Type::fromDoctrine(new JsonType())->value)->toEqual(DoctrineTypeEnum::JSON->value);
    expect(Type::fromDoctrine(new SimpleArrayType())->value)->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->value);
    expect(Type::fromDoctrine(new SmallIntType())->value)->toEqual(DoctrineTypeEnum::SMALLINT->value);
    expect(Type::fromDoctrine(new StringType())->value)->toEqual(DoctrineTypeEnum::STRING->value);
    expect(Type::fromDoctrine(new TextType())->value)->toEqual(DoctrineTypeEnum::TEXT->value);
    expect(Type::fromDoctrine(new TimeType())->value)->toEqual(DoctrineTypeEnum::TIME->value);
    expect(Type::fromDoctrine(new TimeImmutableType())->value)->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->value);

    expect(Type::fromDoctrine(DoctrineTypeEnum::ASCII_STRING)->value)->toEqual(DoctrineTypeEnum::ASCII_STRING->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::BIGINT)->value)->toEqual(DoctrineTypeEnum::BIGINT->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::BINARY)->value)->toEqual(DoctrineTypeEnum::BINARY->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::BLOB)->value)->toEqual(DoctrineTypeEnum::BLOB->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::BOOLEAN)->value)->toEqual(DoctrineTypeEnum::BOOLEAN->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATE)->value)->toEqual(DoctrineTypeEnum::DATE->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATE_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATEINTERVAL)->value)->toEqual(DoctrineTypeEnum::DATEINTERVAL->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATETIME)->value)->toEqual(DoctrineTypeEnum::DATETIME->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATETIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATETIMETZ)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::DECIMAL)->value)->toEqual(DoctrineTypeEnum::DECIMAL->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::FLOAT)->value)->toEqual(DoctrineTypeEnum::FLOAT->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::GUID)->value)->toEqual(DoctrineTypeEnum::GUID->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::INTEGER)->value)->toEqual(DoctrineTypeEnum::INTEGER->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::JSON)->value)->toEqual(DoctrineTypeEnum::JSON->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::SIMPLE_ARRAY)->value)->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::SMALLINT)->value)->toEqual(DoctrineTypeEnum::SMALLINT->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::STRING)->value)->toEqual(DoctrineTypeEnum::STRING->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::TEXT)->value)->toEqual(DoctrineTypeEnum::TEXT->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::TIME)->value)->toEqual(DoctrineTypeEnum::TIME->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::TIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->value);
    expect(Type::fromDoctrine(DoctrineTypeEnum::UNKNOWN)->value)->toEqual(DoctrineTypeEnum::UNKNOWN->value);
});

it('Type::make()', function (): void {
    expect(Type::make(new AsciiStringType())->value)->toEqual(DoctrineTypeEnum::ASCII_STRING->value);
    expect(Type::make(new BigIntType())->value)->toEqual(DoctrineTypeEnum::BIGINT->value);
    expect(Type::make(new BinaryType())->value)->toEqual(DoctrineTypeEnum::BINARY->value);
    expect(Type::make(new BlobType())->value)->toEqual(DoctrineTypeEnum::BLOB->value);
    expect(Type::make(new BooleanType())->value)->toEqual(DoctrineTypeEnum::BOOLEAN->value);
    expect(Type::make(new DateType())->value)->toEqual(DoctrineTypeEnum::DATE->value);
    expect(Type::make(new DateImmutableType())->value)->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->value);
    expect(Type::make(new DateIntervalType())->value)->toEqual(DoctrineTypeEnum::DATEINTERVAL->value);
    expect(Type::make(new DateTimeType())->value)->toEqual(DoctrineTypeEnum::DATETIME->value);
    expect(Type::make(new DateTimeImmutableType())->value)->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->value);
    expect(Type::make(new DateTimeTzType())->value)->toEqual(DoctrineTypeEnum::DATETIMETZ->value);
    expect(Type::make(new DateTimeTzImmutableType())->value)->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value);
    expect(Type::make(new DecimalType())->value)->toEqual(DoctrineTypeEnum::DECIMAL->value);
    expect(Type::make(new FloatType())->value)->toEqual(DoctrineTypeEnum::FLOAT->value);
    expect(Type::make(new GuidType())->value)->toEqual(DoctrineTypeEnum::GUID->value);
    expect(Type::make(new IntegerType())->value)->toEqual(DoctrineTypeEnum::INTEGER->value);
    expect(Type::make(new JsonType())->value)->toEqual(DoctrineTypeEnum::JSON->value);
    expect(Type::make(new SimpleArrayType())->value)->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->value);
    expect(Type::make(new SmallIntType())->value)->toEqual(DoctrineTypeEnum::SMALLINT->value);
    expect(Type::make(new StringType())->value)->toEqual(DoctrineTypeEnum::STRING->value);
    expect(Type::make(new TextType())->value)->toEqual(DoctrineTypeEnum::TEXT->value);
    expect(Type::make(new TimeType())->value)->toEqual(DoctrineTypeEnum::TIME->value);
    expect(Type::make(new TimeImmutableType())->value)->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->value);

    expect(Type::make(DoctrineTypeEnum::ASCII_STRING)->value)->toEqual(DoctrineTypeEnum::ASCII_STRING->value);
    expect(Type::make(DoctrineTypeEnum::BIGINT)->value)->toEqual(DoctrineTypeEnum::BIGINT->value);
    expect(Type::make(DoctrineTypeEnum::BINARY)->value)->toEqual(DoctrineTypeEnum::BINARY->value);
    expect(Type::make(DoctrineTypeEnum::BLOB)->value)->toEqual(DoctrineTypeEnum::BLOB->value);
    expect(Type::make(DoctrineTypeEnum::BOOLEAN)->value)->toEqual(DoctrineTypeEnum::BOOLEAN->value);
    expect(Type::make(DoctrineTypeEnum::DATE)->value)->toEqual(DoctrineTypeEnum::DATE->value);
    expect(Type::make(DoctrineTypeEnum::DATE_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->value);
    expect(Type::make(DoctrineTypeEnum::DATEINTERVAL)->value)->toEqual(DoctrineTypeEnum::DATEINTERVAL->value);
    expect(Type::make(DoctrineTypeEnum::DATETIME)->value)->toEqual(DoctrineTypeEnum::DATETIME->value);
    expect(Type::make(DoctrineTypeEnum::DATETIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->value);
    expect(Type::make(DoctrineTypeEnum::DATETIMETZ)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ->value);
    expect(Type::make(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value);
    expect(Type::make(DoctrineTypeEnum::DECIMAL)->value)->toEqual(DoctrineTypeEnum::DECIMAL->value);
    expect(Type::make(DoctrineTypeEnum::FLOAT)->value)->toEqual(DoctrineTypeEnum::FLOAT->value);
    expect(Type::make(DoctrineTypeEnum::GUID)->value)->toEqual(DoctrineTypeEnum::GUID->value);
    expect(Type::make(DoctrineTypeEnum::INTEGER)->value)->toEqual(DoctrineTypeEnum::INTEGER->value);
    expect(Type::make(DoctrineTypeEnum::JSON)->value)->toEqual(DoctrineTypeEnum::JSON->value);
    expect(Type::make(DoctrineTypeEnum::SIMPLE_ARRAY)->value)->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->value);
    expect(Type::make(DoctrineTypeEnum::SMALLINT)->value)->toEqual(DoctrineTypeEnum::SMALLINT->value);
    expect(Type::make(DoctrineTypeEnum::STRING)->value)->toEqual(DoctrineTypeEnum::STRING->value);
    expect(Type::make(DoctrineTypeEnum::TEXT)->value)->toEqual(DoctrineTypeEnum::TEXT->value);
    expect(Type::make(DoctrineTypeEnum::TIME)->value)->toEqual(DoctrineTypeEnum::TIME->value);
    expect(Type::make(DoctrineTypeEnum::TIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->value);
    expect(Type::make(DoctrineTypeEnum::UNKNOWN)->value)->toEqual(DoctrineTypeEnum::UNKNOWN->value);

    expect(Type::make(Types::ASCII_STRING)->value)->toEqual(DoctrineTypeEnum::ASCII_STRING->value);
    expect(Type::make(Types::BIGINT)->value)->toEqual(DoctrineTypeEnum::BIGINT->value);
    expect(Type::make(Types::BINARY)->value)->toEqual(DoctrineTypeEnum::BINARY->value);
    expect(Type::make(Types::BLOB)->value)->toEqual(DoctrineTypeEnum::BLOB->value);
    expect(Type::make(Types::BOOLEAN)->value)->toEqual(DoctrineTypeEnum::BOOLEAN->value);
    expect(Type::make(Types::DATE_MUTABLE)->value)->toEqual(DoctrineTypeEnum::DATE->value);
    expect(Type::make(Types::DATE_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE->value);
    expect(Type::make(Types::DATEINTERVAL)->value)->toEqual(DoctrineTypeEnum::DATEINTERVAL->value);
    expect(Type::make(Types::DATETIME_MUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIME->value);
    expect(Type::make(Types::DATETIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE->value);
    expect(Type::make(Types::DATETIMETZ_MUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ->value);
    expect(Type::make(Types::DATETIMETZ_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value);
    expect(Type::make(Types::DECIMAL)->value)->toEqual(DoctrineTypeEnum::DECIMAL->value);
    expect(Type::make(Types::FLOAT)->value)->toEqual(DoctrineTypeEnum::FLOAT->value);
    expect(Type::make(Types::GUID)->value)->toEqual(DoctrineTypeEnum::GUID->value);
    expect(Type::make(Types::INTEGER)->value)->toEqual(DoctrineTypeEnum::INTEGER->value);
    expect(Type::make(Types::JSON)->value)->toEqual(DoctrineTypeEnum::JSON->value);
    expect(Type::make(Types::SIMPLE_ARRAY)->value)->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY->value);
    expect(Type::make(Types::SMALLINT)->value)->toEqual(DoctrineTypeEnum::SMALLINT->value);
    expect(Type::make(Types::STRING)->value)->toEqual(DoctrineTypeEnum::STRING->value);
    expect(Type::make(Types::TEXT)->value)->toEqual(DoctrineTypeEnum::TEXT->value);
    expect(Type::make(Types::TIME_MUTABLE)->value)->toEqual(DoctrineTypeEnum::TIME->value);
    expect(Type::make(Types::TIME_IMMUTABLE)->value)->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE->value);

    expect(Type::make('unknown')->value)->toEqual('unknown');
    expect(Type::make('nope')->value)->toEqual('nope');
    expect(Type::make(' ')->value)->toEqual(' ');
    expect(Type::make('')->value)->toEqual('');
});

it('Type::toPhp()', function (): void {
    expect(Type::make('null')->toPhp())->toEqual(PhpTypeEnum::NULL->value);
    expect(Type::make('bool')->toPhp())->toEqual(PhpTypeEnum::BOOL->value);
    expect(Type::make('int')->toPhp())->toEqual(PhpTypeEnum::INT->value);
    expect(Type::make('float')->toPhp())->toEqual(PhpTypeEnum::FLOAT->value);
    expect(Type::make('string')->toPhp())->toEqual(PhpTypeEnum::STRING->value);
    expect(Type::make('array')->toPhp())->toEqual(PhpTypeEnum::ARRAY->value);
    expect(Type::make('object')->toPhp())->toEqual(PhpTypeEnum::OBJECT->value);
    expect(Type::make('resource')->toPhp())->toEqual(PhpTypeEnum::RESOURCE->value);
    expect(Type::make('unknown')->toPhp())->toEqual(null);
    expect(Type::make('nope')->toPhp())->toEqual(null);
    expect(Type::make(' ')->toPhp())->toEqual(null);
    expect(Type::make('')->toPhp())->toEqual(null);
});

it('Type::toJavascript()', function (): void {
    expect(Type::make('null')->toJavascript())->toEqual(JavaScriptTypeEnum::NULL->value);
    expect(Type::make('undefined')->toJavascript())->toEqual(JavaScriptTypeEnum::UNDEFINED->value);
    expect(Type::make('boolean')->toJavascript())->toEqual(JavaScriptTypeEnum::BOOLEAN->value);
    expect(Type::make('number')->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER->value);
    expect(Type::make('string')->toJavascript())->toEqual(JavaScriptTypeEnum::STRING->value);
    expect(Type::make('symbol')->toJavascript())->toEqual(JavaScriptTypeEnum::SYMBOL->value);
    expect(Type::make('bigint')->toJavascript())->toEqual(JavaScriptTypeEnum::BIGINT->value);
    expect(Type::make('object')->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT->value);
    expect(Type::make('unknown')->toJavascript())->toEqual(null);
    expect(Type::make('nope')->toJavascript())->toEqual(null);
    expect(Type::make(' ')->toJavascript())->toEqual(null);
    expect(Type::make('')->toJavascript())->toEqual(null);
});

it('Type::toArray()', function (): void {
    expect(Type::make('string')->toArray())->toEqual([
        'value' => 'string',
        'doctrine' => 'string',
        'php' => 'string',
        'javascript' => 'string',
    ]);
    expect(Type::make('bigint')->toArray())->toEqual([
        'value' => 'bigint',
        'doctrine' => 'bigint',
        'php' => 'string',
        'javascript' => 'bigint',
    ]);
    expect(Type::make('nope')->toArray())->toEqual([
        'value' => 'nope',
        'doctrine' => null,
        'php' => null,
        'javascript' => null,
    ]);
});

it('Type::toJson()', function (): void {
    expect(Type::make('string')->toJson())->toEqual(json_encode([
        'value' => 'string',
        'doctrine' => 'string',
        'php' => 'string',
        'javascript' => 'string',
    ]));
    expect(Type::make('bigint')->toJson())->toEqual(json_encode([
        'value' => 'bigint',
        'doctrine' => 'bigint',
        'php' => 'string',
        'javascript' => 'bigint',
    ]));
    expect(Type::make('nope')->toJson())->toEqual(json_encode([
        'value' => 'nope',
        'doctrine' => null,
        'php' => null,
        'javascript' => null,
    ]));
});

it('Type::jsonSerialize()', function (): void {
    expect(Type::make('string')->jsonSerialize())->toEqual([
        'value' => 'string',
        'doctrine' => 'string',
        'php' => 'string',
        'javascript' => 'string',
    ]);
    expect(Type::make('bigint')->jsonSerialize())->toEqual([
        'value' => 'bigint',
        'doctrine' => 'bigint',
        'php' => 'string',
        'javascript' => 'bigint',
    ]);
    expect(Type::make('nope')->jsonSerialize())->toEqual([
        'value' => 'nope',
        'doctrine' => null,
        'php' => null,
        'javascript' => null,
    ]);
});

it('Type::__toString()', function (): void {
    expect((string) Type::make('string'))->toEqual('string');
    expect((string) Type::make('bigint'))->toEqual('bigint');
    expect((string) Type::make('nope'))->toEqual('nope');
});
