<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Types;

use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\PhpEnhancedEnum\Concerns\Enumerable;
use VicGutt\InspectDb\Contracts\Types\TypeEnumContract;

enum JavaScriptTypeEnum: string implements TypeEnumContract
{
    use Enumerable;

    case NULL = 'null';
    case UNDEFINED = 'undefined';
    case BOOLEAN = 'boolean';
    case NUMBER = 'number';
    case STRING = 'string';
    case SYMBOL = 'symbol';
    case BIGINT = 'bigint';
    case OBJECT = 'object';
    case UNKNOWN = 'unknown';

    public static function fromDoctrine(DoctrineType|DoctrineTypeEnum $type): self
    {
        return DoctrineTypeEnum::fromDoctrine($type)->toJavascript();
    }

    public static function fromString(string $type): self
    {
        return self::tryFrom($type)
            ?: DoctrineTypeEnum::tryFrom($type)?->toJavascript()
            ?: PhpTypeEnum::tryFrom($type)?->toJavascript()
            ?: self::UNKNOWN;
    }

    public static function fromPhp(PhpTypeEnum $type): self
    {
        return $type->toJavascript();
    }

    public static function fromJavascript(self $type): self
    {
        return $type;
    }

    public function toPhp(): PhpTypeEnum
    {
        return match ($this) {
            JavaScriptTypeEnum::NULL => PhpTypeEnum::NULL,
            JavaScriptTypeEnum::UNDEFINED => PhpTypeEnum::NULL,
            JavaScriptTypeEnum::BOOLEAN => PhpTypeEnum::BOOL,
            JavaScriptTypeEnum::NUMBER => PhpTypeEnum::FLOAT,
            JavaScriptTypeEnum::STRING => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::SYMBOL => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::BIGINT => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::OBJECT => PhpTypeEnum::OBJECT,
            JavaScriptTypeEnum::UNKNOWN => PhpTypeEnum::UNKNOWN,
        };
    }

    public function toJavascript(): self
    {
        return $this;
    }

    public function raw(): ?string
    {
        if ($this->value === self::UNKNOWN->value) {
            return null;
        }

        return $this->value;
    }
}
