<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Exceptions;

use VicGutt\InspectDb\Types\Type;

/**
 * @codeCoverageIgnore
 */
class TypeException extends InspectDbException
{
    public static function jsonUnencodable(Type $type): self
    {
        return new self('The type `' . $type::class . '` could not be json encoded.');
    }
}
