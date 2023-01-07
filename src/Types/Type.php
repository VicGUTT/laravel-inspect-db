<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Types;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\InspectDb\Exceptions\TypeException;

/**
 * @implements Arrayable<string, null|string>
 */
class Type implements Arrayable, Jsonable, JsonSerializable
{
    public function __construct(public readonly null|string $value)
    {
    }

    public static function make(DoctrineType|DoctrineTypeEnum|string $type): self
    {
        if (is_string($type)) {
            return new self($type);
        }

        return self::fromDoctrine($type);
    }

    public static function fromDoctrine(DoctrineType|DoctrineTypeEnum $type): self
    {
        return new self(DoctrineTypeEnum::fromDoctrine($type)->value);
    }

    public function toDoctrine(): ?string
    {
        return DoctrineTypeEnum::fromString($this->value)->raw();
    }

    public function toPhp(): ?string
    {
        return PhpTypeEnum::fromString($this->value)->raw();
    }

    public function toJavascript(): ?string
    {
        return JavaScriptTypeEnum::fromString($this->value)->raw();
    }

    /**
     * Convert the instance to its array representation.
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'doctrine' => $this->toDoctrine(),
            'php' => $this->toPhp(),
            'javascript' => $this->toJavascript(),
        ];
    }

    /**
     * Convert the instance to its JSON representation.
     *
     * @param  int  $options
     */
    public function toJson($options = 0): string
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw TypeException::jsonUnencodable($this);
        }

        return $json;
    }

    /**
     * Convert the instance into something JSON serializable.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to its string representation.
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
