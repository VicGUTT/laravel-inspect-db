<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Types;

use Doctrine\DBAL\Types\Types;
use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\PhpEnhancedEnum\Concerns\Enumerable;
use VicGutt\InspectDb\Contracts\Types\TypeEnumContract;

enum PhpTypeEnum: string implements TypeEnumContract
{
    use Enumerable;

    case NULL = 'null';
    case BOOL = 'bool';
    case INT = 'int';
    case FLOAT = 'float';
    case STRING = 'string';
    case ARRAY = 'array';
    case OBJECT = 'object';
    case RESOURCE = 'resource';
    case UNKNOWN = 'unknown';

    public static function fromDoctrineType(DoctrineType $type): self
    {
        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        return self::fromString($type->getName());
    }

    public static function fromString(string $type): self
    {
        return match ($type) {
            'null' => PhpTypeEnum::NULL,
            'string', 'decimal' => PhpTypeEnum::STRING,
            'int', 'integer' => PhpTypeEnum::INT,
            'real', 'float', 'double' => PhpTypeEnum::FLOAT,
            'bool', 'boolean' => PhpTypeEnum::BOOL,
            'resource' => PhpTypeEnum::RESOURCE,
            'object' => PhpTypeEnum::OBJECT,
            'array', 'json', 'collection' => PhpTypeEnum::ARRAY,
            'date', 'datetime', 'timestamp' => PhpTypeEnum::STRING,

            /**
             * JavaScript types mappings to PHP types.
             */
            // 'null' => PhpTypeEnum::NULL,
            'undefined' => PhpTypeEnum::NULL,
            // 'boolean' => PhpTypeEnum::BOOL,
            'number' => PhpTypeEnum::INT,
            // 'string' => PhpTypeEnum::STRING,
            'symbol' => PhpTypeEnum::STRING,
            'bigint' => PhpTypeEnum::STRING,
            // 'object' => PhpTypeEnum::OBJECT,
            // 'unknown' => PhpTypeEnum::UNKNOWN,

            /**
             * Doctrine types mappings to PHP types.
             *
             * Inspired by but not fully abiding by the link below.
             *
             * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#mapping-matrix
             */
            Types::STRING, Types::DECIMAL, Types::ASCII_STRING, Types::BIGINT, Types::TEXT, Types::GUID => PhpTypeEnum::STRING,
            Types::INTEGER, Types::SMALLINT => PhpTypeEnum::INT,
            Types::FLOAT => PhpTypeEnum::FLOAT,
            Types::BOOLEAN => PhpTypeEnum::BOOL,
            Types::BINARY, Types::BLOB => PhpTypeEnum::RESOURCE,
            // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
            Types::OBJECT => PhpTypeEnum::OBJECT,
            // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
            Types::ARRAY, Types::SIMPLE_ARRAY, Types::JSON => PhpTypeEnum::ARRAY,
            Types::DATE_MUTABLE, Types::DATE_IMMUTABLE, Types::DATEINTERVAL, Types::DATETIME_MUTABLE,
            Types::DATETIME_IMMUTABLE, Types::DATETIMETZ_MUTABLE, Types::DATETIMETZ_IMMUTABLE,
            Types::TIME_MUTABLE, Types::TIME_IMMUTABLE => PhpTypeEnum::STRING,

            default => PhpTypeEnum::UNKNOWN,
        };
    }

    public static function fromPhp(self $type): self
    {
        return $type;
    }

    public static function fromJavascript(JavaScriptTypeEnum $type): self
    {
        return $type->toPhp();
    }

    public function toPhp(): self
    {
        return $this;
    }

    public function toJavascript(): JavaScriptTypeEnum
    {
        return match ($this) {
            PhpTypeEnum::NULL => JavaScriptTypeEnum::NULL,
            PhpTypeEnum::BOOL => JavaScriptTypeEnum::BOOLEAN,
            PhpTypeEnum::INT => JavaScriptTypeEnum::NUMBER,
            PhpTypeEnum::FLOAT => JavaScriptTypeEnum::NUMBER,
            PhpTypeEnum::STRING => JavaScriptTypeEnum::STRING,
            PhpTypeEnum::ARRAY => JavaScriptTypeEnum::OBJECT,
            PhpTypeEnum::OBJECT => JavaScriptTypeEnum::OBJECT,
            PhpTypeEnum::RESOURCE => JavaScriptTypeEnum::OBJECT,
            PhpTypeEnum::UNKNOWN => JavaScriptTypeEnum::UNKNOWN,
            default => JavaScriptTypeEnum::UNKNOWN,
        };
    }

    public function raw(): ?string
    {
        return match ($this) {
            PhpTypeEnum::NULL => PhpTypeEnum::NULL->value,
            PhpTypeEnum::BOOL => PhpTypeEnum::BOOL->value,
            PhpTypeEnum::INT => PhpTypeEnum::INT->value,
            PhpTypeEnum::FLOAT => PhpTypeEnum::FLOAT->value,
            PhpTypeEnum::STRING => PhpTypeEnum::STRING->value,
            PhpTypeEnum::ARRAY => PhpTypeEnum::ARRAY->value,
            PhpTypeEnum::OBJECT => PhpTypeEnum::OBJECT->value,
            PhpTypeEnum::RESOURCE => PhpTypeEnum::RESOURCE->value,
            PhpTypeEnum::UNKNOWN => null,
            default => null,
        };
    }
}
