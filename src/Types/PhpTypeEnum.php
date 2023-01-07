<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Types;

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

    public static function fromDoctrine(DoctrineType|DoctrineTypeEnum $type): self
    {
        return DoctrineTypeEnum::fromDoctrine($type)->toPhp();
    }

    public static function fromString(string $type): self
    {
        return self::tryFrom($type)
            ?: DoctrineTypeEnum::tryFrom($type)?->toPhp()
            ?: JavaScriptTypeEnum::tryFrom($type)?->toPhp()
            ?: self::UNKNOWN;
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
            PhpTypeEnum::RESOURCE => JavaScriptTypeEnum::STRING,
            PhpTypeEnum::UNKNOWN => JavaScriptTypeEnum::UNKNOWN,
        };
    }

    public function raw(): ?string
    {
        if ($this->value === self::UNKNOWN->value) {
            return null;
        }

        return $this->value;
    }
}
