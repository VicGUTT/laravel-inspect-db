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

$doctrineTypes = [
    Types::ASCII_STRING,
    Types::BIGINT,
    Types::BINARY,
    Types::BLOB,
    Types::BOOLEAN,
    Types::DATE_MUTABLE,
    Types::DATE_IMMUTABLE,
    Types::DATEINTERVAL,
    Types::DATETIME_MUTABLE,
    Types::DATETIME_IMMUTABLE,
    Types::DATETIMETZ_MUTABLE,
    Types::DATETIMETZ_IMMUTABLE,
    Types::DECIMAL,
    Types::FLOAT,
    Types::GUID,
    Types::INTEGER,
    Types::JSON,
    Types::SIMPLE_ARRAY,
    Types::SMALLINT,
    Types::STRING,
    Types::TEXT,
    Types::TIME_MUTABLE,
    Types::TIME_IMMUTABLE,
];

it('implements `VicGutt\InspectDb\Contracts\Types\TypeEnumContract`', function (): void {
    expect(is_subclass_of(DoctrineTypeEnum::class, TypeEnumContract::class))->toEqual(true);
});

it('DoctrineTypeEnum::values()', function () use ($doctrineTypes): void {
    expect(DoctrineTypeEnum::values())->toEqual([...$doctrineTypes, 'unknown']);
});

it('DoctrineTypeEnum::fromDoctrine()', function (): void {
    expect(DoctrineTypeEnum::fromDoctrine(new AsciiStringType()))->toEqual(DoctrineTypeEnum::ASCII_STRING);
    expect(DoctrineTypeEnum::fromDoctrine(new BigIntType()))->toEqual(DoctrineTypeEnum::BIGINT);
    expect(DoctrineTypeEnum::fromDoctrine(new BinaryType()))->toEqual(DoctrineTypeEnum::BINARY);
    expect(DoctrineTypeEnum::fromDoctrine(new BlobType()))->toEqual(DoctrineTypeEnum::BLOB);
    expect(DoctrineTypeEnum::fromDoctrine(new BooleanType()))->toEqual(DoctrineTypeEnum::BOOLEAN);
    expect(DoctrineTypeEnum::fromDoctrine(new DateType()))->toEqual(DoctrineTypeEnum::DATE);
    expect(DoctrineTypeEnum::fromDoctrine(new DateImmutableType()))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(new DateIntervalType()))->toEqual(DoctrineTypeEnum::DATEINTERVAL);
    expect(DoctrineTypeEnum::fromDoctrine(new DateTimeType()))->toEqual(DoctrineTypeEnum::DATETIME);
    expect(DoctrineTypeEnum::fromDoctrine(new DateTimeImmutableType()))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(new DateTimeTzType()))->toEqual(DoctrineTypeEnum::DATETIMETZ);
    expect(DoctrineTypeEnum::fromDoctrine(new DateTimeTzImmutableType()))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(new DecimalType()))->toEqual(DoctrineTypeEnum::DECIMAL);
    expect(DoctrineTypeEnum::fromDoctrine(new FloatType()))->toEqual(DoctrineTypeEnum::FLOAT);
    expect(DoctrineTypeEnum::fromDoctrine(new GuidType()))->toEqual(DoctrineTypeEnum::GUID);
    expect(DoctrineTypeEnum::fromDoctrine(new IntegerType()))->toEqual(DoctrineTypeEnum::INTEGER);
    expect(DoctrineTypeEnum::fromDoctrine(new JsonType()))->toEqual(DoctrineTypeEnum::JSON);
    expect(DoctrineTypeEnum::fromDoctrine(new SimpleArrayType()))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY);
    expect(DoctrineTypeEnum::fromDoctrine(new SmallIntType()))->toEqual(DoctrineTypeEnum::SMALLINT);
    expect(DoctrineTypeEnum::fromDoctrine(new StringType()))->toEqual(DoctrineTypeEnum::STRING);
    expect(DoctrineTypeEnum::fromDoctrine(new TextType()))->toEqual(DoctrineTypeEnum::TEXT);
    expect(DoctrineTypeEnum::fromDoctrine(new TimeType()))->toEqual(DoctrineTypeEnum::TIME);
    expect(DoctrineTypeEnum::fromDoctrine(new TimeImmutableType()))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE);

    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::BINARY))->toEqual(DoctrineTypeEnum::BINARY);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::BLOB))->toEqual(DoctrineTypeEnum::BLOB);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE))->toEqual(DoctrineTypeEnum::DATE);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME))->toEqual(DoctrineTypeEnum::DATETIME);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ))->toEqual(DoctrineTypeEnum::DATETIMETZ);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::GUID))->toEqual(DoctrineTypeEnum::GUID);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::JSON))->toEqual(DoctrineTypeEnum::JSON);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::STRING))->toEqual(DoctrineTypeEnum::STRING);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::TEXT))->toEqual(DoctrineTypeEnum::TEXT);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME))->toEqual(DoctrineTypeEnum::TIME);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE);
    expect(DoctrineTypeEnum::fromDoctrine(DoctrineTypeEnum::UNKNOWN))->toEqual(DoctrineTypeEnum::UNKNOWN);
});

it('DoctrineTypeEnum::fromString()', function (): void {
    expect(DoctrineTypeEnum::fromString(Types::ASCII_STRING))->toEqual(DoctrineTypeEnum::ASCII_STRING);
    expect(DoctrineTypeEnum::fromString(Types::BIGINT))->toEqual(DoctrineTypeEnum::BIGINT);
    expect(DoctrineTypeEnum::fromString(Types::BINARY))->toEqual(DoctrineTypeEnum::BINARY);
    expect(DoctrineTypeEnum::fromString(Types::BLOB))->toEqual(DoctrineTypeEnum::BLOB);
    expect(DoctrineTypeEnum::fromString(Types::BOOLEAN))->toEqual(DoctrineTypeEnum::BOOLEAN);
    expect(DoctrineTypeEnum::fromString(Types::DATE_MUTABLE))->toEqual(DoctrineTypeEnum::DATE);
    expect(DoctrineTypeEnum::fromString(Types::DATE_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATE_IMMUTABLE);
    expect(DoctrineTypeEnum::fromString(Types::DATEINTERVAL))->toEqual(DoctrineTypeEnum::DATEINTERVAL);
    expect(DoctrineTypeEnum::fromString(Types::DATETIME_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIME);
    expect(DoctrineTypeEnum::fromString(Types::DATETIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIME_IMMUTABLE);
    expect(DoctrineTypeEnum::fromString(Types::DATETIMETZ_MUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ);
    expect(DoctrineTypeEnum::fromString(Types::DATETIMETZ_IMMUTABLE))->toEqual(DoctrineTypeEnum::DATETIMETZ_IMMUTABLE);
    expect(DoctrineTypeEnum::fromString(Types::DECIMAL))->toEqual(DoctrineTypeEnum::DECIMAL);
    expect(DoctrineTypeEnum::fromString(Types::FLOAT))->toEqual(DoctrineTypeEnum::FLOAT);
    expect(DoctrineTypeEnum::fromString(Types::GUID))->toEqual(DoctrineTypeEnum::GUID);
    expect(DoctrineTypeEnum::fromString(Types::INTEGER))->toEqual(DoctrineTypeEnum::INTEGER);
    expect(DoctrineTypeEnum::fromString(Types::JSON))->toEqual(DoctrineTypeEnum::JSON);
    expect(DoctrineTypeEnum::fromString(Types::SIMPLE_ARRAY))->toEqual(DoctrineTypeEnum::SIMPLE_ARRAY);
    expect(DoctrineTypeEnum::fromString(Types::SMALLINT))->toEqual(DoctrineTypeEnum::SMALLINT);
    expect(DoctrineTypeEnum::fromString(Types::STRING))->toEqual(DoctrineTypeEnum::STRING);
    expect(DoctrineTypeEnum::fromString(Types::TEXT))->toEqual(DoctrineTypeEnum::TEXT);
    expect(DoctrineTypeEnum::fromString(Types::TIME_MUTABLE))->toEqual(DoctrineTypeEnum::TIME);
    expect(DoctrineTypeEnum::fromString(Types::TIME_IMMUTABLE))->toEqual(DoctrineTypeEnum::TIME_IMMUTABLE);
    expect(DoctrineTypeEnum::fromString('unknown'))->toEqual(DoctrineTypeEnum::UNKNOWN);
    expect(DoctrineTypeEnum::fromString('nope'))->toEqual(DoctrineTypeEnum::UNKNOWN);
    expect(DoctrineTypeEnum::fromString(' '))->toEqual(DoctrineTypeEnum::UNKNOWN);
    expect(DoctrineTypeEnum::fromString(''))->toEqual(DoctrineTypeEnum::UNKNOWN);
});

it('DoctrineTypeEnum::fromPhp()', function (PhpTypeEnum $type): void {
    expect(DoctrineTypeEnum::fromPhp($type))->toEqual(
        DoctrineTypeEnum::from(config('inspect-db.doctrine_type.from.php')[$type->value])
    );
})->with(PhpTypeEnum::cases());

it('DoctrineTypeEnum::fromJavascript()', function (JavaScriptTypeEnum $type): void {
    expect(DoctrineTypeEnum::fromJavascript($type))->toEqual(
        DoctrineTypeEnum::from(config('inspect-db.doctrine_type.from.javascript')[$type->value])
    );
})->with(JavaScriptTypeEnum::cases());

it('DoctrineTypeEnum::toPhp()', function (DoctrineTypeEnum $type): void {
    expect($type->toPhp())->toEqual(
        PhpTypeEnum::from(config('inspect-db.doctrine_type.to.php')[$type->value])
    );
})->with(DoctrineTypeEnum::cases());

it('DoctrineTypeEnum::toJavascript()', function (DoctrineTypeEnum $type): void {
    expect($type->toJavascript())->toEqual(
        JavaScriptTypeEnum::from(config('inspect-db.doctrine_type.to.javascript')[$type->value])
    );
})->with(DoctrineTypeEnum::cases());

it('DoctrineTypeEnum::raw()', function (DoctrineTypeEnum $type): void {
    expect($type->raw())->toEqual($type->value === DoctrineTypeEnum::UNKNOWN->value ? null : $type->value);
})->with(DoctrineTypeEnum::cases());
