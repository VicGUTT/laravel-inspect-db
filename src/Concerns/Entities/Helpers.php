<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Concerns\Entities;

trait Helpers
{
    protected function setProperties(array $properties, array $defaults = []): void
    {
        foreach (array_merge($defaults, $properties) as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
