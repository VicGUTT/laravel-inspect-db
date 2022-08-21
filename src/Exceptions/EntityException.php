<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Exceptions;

use VicGutt\InspectDb\Entities\Entity;

class EntityException extends InspectDbException
{
    public static function jsonUnencodable(Entity $entity): self
    {
        return new self('The entity `' . $entity::class . '` could not be json encoded.');
    }
}
