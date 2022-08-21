<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Types;

use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\InspectDb\Contracts\Types\TypeEnumContract;

enum JavaScriptTypeEnum: string implements TypeEnumContract
{
    case NULL = 'null';
    case UNDEFINED = 'undefined';
    case BOOLEAN = 'boolean';
    case NUMBER = 'number';
    case STRING = 'string';
    case SYMBOL = 'symbol';
    case BIGINT = 'bigint';
    case OBJECT = 'object';
    case UNKNOWN = 'unknown';

    public static function fromDoctrineType(DoctrineType $type): self
    {
        // @phpstan-ignore-next-line Yeah yeah I know it's deprecated
        return self::fromString($type->getName());
    }

    public static function fromString(string $type): self
    {
        $value = match ($type) {
            'null' => JavaScriptTypeEnum::NULL,
            'undefined' => JavaScriptTypeEnum::UNDEFINED,
            'boolean' => JavaScriptTypeEnum::BOOLEAN,
            'number' => JavaScriptTypeEnum::NUMBER,
            'string' => JavaScriptTypeEnum::STRING,
            'symbol' => JavaScriptTypeEnum::SYMBOL,
            'bigint' => JavaScriptTypeEnum::BIGINT,
            'object' => JavaScriptTypeEnum::OBJECT,
            default => JavaScriptTypeEnum::UNKNOWN,
        };

        if ($value !== JavaScriptTypeEnum::UNKNOWN) {
            return $value;
        }

        return self::fromPhp(PhpTypeEnum::fromString($type));
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
            JavaScriptTypeEnum::NUMBER => PhpTypeEnum::INT,
            JavaScriptTypeEnum::STRING => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::SYMBOL => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::BIGINT => PhpTypeEnum::STRING,
            JavaScriptTypeEnum::OBJECT => PhpTypeEnum::OBJECT,
            JavaScriptTypeEnum::UNKNOWN => PhpTypeEnum::UNKNOWN,
            default => PhpTypeEnum::UNKNOWN,
        };
    }

    public function toJavascript(): self
    {
        return $this;
    }

    public function raw(): ?string
    {
        return match ($this) {
            JavaScriptTypeEnum::NULL => JavaScriptTypeEnum::NULL->value,
            JavaScriptTypeEnum::UNDEFINED => JavaScriptTypeEnum::UNDEFINED->value,
            JavaScriptTypeEnum::BOOLEAN => JavaScriptTypeEnum::BOOLEAN->value,
            JavaScriptTypeEnum::NUMBER => JavaScriptTypeEnum::NUMBER->value,
            JavaScriptTypeEnum::STRING => JavaScriptTypeEnum::STRING->value,
            JavaScriptTypeEnum::SYMBOL => JavaScriptTypeEnum::SYMBOL->value,
            JavaScriptTypeEnum::BIGINT => JavaScriptTypeEnum::BIGINT->value,
            JavaScriptTypeEnum::OBJECT => JavaScriptTypeEnum::OBJECT->value,
            JavaScriptTypeEnum::UNKNOWN => null,
            default => null,
        };
    }
}
