<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Entities;

use ArrayAccess;
use ReflectionClass;
use JsonSerializable;
use ReflectionProperty;
use Doctrine\DBAL\Schema\AbstractAsset;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use VicGutt\InspectDb\Exceptions\EntityException;

/**
 * @implements Arrayable<array-key, mixed>
 * @implements ArrayAccess<array-key, mixed>
 */
abstract class Entity implements Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    use Macroable;

    /**
     * Return the underlying Doctrine\DBAL schema asset.
     */
    abstract public function schema(): AbstractAsset;

    /**
     * Determine if the given offset exists.
     */
    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }

    /**
     * Get the value for a given offset.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->{$offset};
    }

    /**
     * Set the value for a given offset.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->{$offset} = $value;
    }

    /**
     * Unset the value for a given offset.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->{$offset});
    }

    /**
     * Convert the instance to its array representation.
     */
    public function toArray(): array
    {
        $properties = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        return array_reduce($properties, function (array $acc, ReflectionProperty $property): array {
            $value = $property->getValue($this);

            if ($value instanceof Arrayable) {
                $value = $value->toArray();
            }

            $acc[$property->getName()] = $value;

            return $acc;
        }, []);
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
            throw EntityException::jsonUnencodable($this);
        }

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Determine if the given key exists on the instance.
     */
    public function __isset(string $key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Unset a key on the instance.
     */
    public function __unset(string $key): void
    {
        $this->offsetUnset($key);
    }

    /**
     * Convert the instance to its string representation.
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
