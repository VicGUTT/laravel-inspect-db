<?php

declare(strict_types=1);

use VicGutt\InspectDb\Types\PhpTypeEnum;
use VicGutt\InspectDb\Types\DoctrineTypeEnum;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;

return [
    'doctrine_type' => [

        'from' => [
            'php' => [
                PhpTypeEnum::NULL->value     => DoctrineTypeEnum::UNKNOWN->value,
                PhpTypeEnum::BOOL->value     => DoctrineTypeEnum::BOOLEAN->value,
                PhpTypeEnum::INT->value      => DoctrineTypeEnum::INTEGER->value,
                PhpTypeEnum::FLOAT->value    => DoctrineTypeEnum::FLOAT->value,
                PhpTypeEnum::STRING->value   => DoctrineTypeEnum::STRING->value,
                PhpTypeEnum::ARRAY->value    => DoctrineTypeEnum::JSON->value,
                PhpTypeEnum::OBJECT->value   => DoctrineTypeEnum::JSON->value,
                PhpTypeEnum::RESOURCE->value => DoctrineTypeEnum::BLOB->value,
                PhpTypeEnum::UNKNOWN->value  => DoctrineTypeEnum::UNKNOWN->value,
            ],

            'javascript' => [
                JavaScriptTypeEnum::NULL->value      => DoctrineTypeEnum::UNKNOWN->value,
                JavaScriptTypeEnum::UNDEFINED->value => DoctrineTypeEnum::UNKNOWN->value,
                JavaScriptTypeEnum::BOOLEAN->value   => DoctrineTypeEnum::BOOLEAN->value,
                JavaScriptTypeEnum::NUMBER->value    => DoctrineTypeEnum::FLOAT->value,
                JavaScriptTypeEnum::STRING->value    => DoctrineTypeEnum::STRING->value,
                JavaScriptTypeEnum::SYMBOL->value    => DoctrineTypeEnum::STRING->value,
                JavaScriptTypeEnum::BIGINT->value    => DoctrineTypeEnum::BIGINT->value,
                JavaScriptTypeEnum::OBJECT->value    => DoctrineTypeEnum::JSON->value,
                JavaScriptTypeEnum::UNKNOWN->value   => DoctrineTypeEnum::UNKNOWN->value,
            ],
        ],

        'to' => [
            /**
             * Doctrine types mappings to PHP types.
             * Inspired by but not fully abiding by the link below.
             *
             * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#mapping-matrix
             */
            'php' => [
                DoctrineTypeEnum::ASCII_STRING->value         => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::BIGINT->value               => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::BINARY->value               => PhpTypeEnum::RESOURCE->value,
                DoctrineTypeEnum::BLOB->value                 => PhpTypeEnum::RESOURCE->value,
                DoctrineTypeEnum::BOOLEAN->value              => PhpTypeEnum::BOOL->value,
                DoctrineTypeEnum::DATE->value                 => PhpTypeEnum::STRING->value, // Originally: '\DateTime'
                DoctrineTypeEnum::DATE_IMMUTABLE->value       => PhpTypeEnum::STRING->value, // Not present originally
                DoctrineTypeEnum::DATEINTERVAL->value         => PhpTypeEnum::STRING->value, // Not present originally
                DoctrineTypeEnum::DATETIME->value             => PhpTypeEnum::STRING->value, // Originally: '\DateTime'
                DoctrineTypeEnum::DATETIME_IMMUTABLE->value   => PhpTypeEnum::STRING->value, // Not present originally
                DoctrineTypeEnum::DATETIMETZ->value           => PhpTypeEnum::STRING->value, // Originally: '\DateTime'
                DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value => PhpTypeEnum::STRING->value, // Not present originally
                DoctrineTypeEnum::DECIMAL->value              => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::FLOAT->value                => PhpTypeEnum::FLOAT->value,
                DoctrineTypeEnum::GUID->value                 => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::INTEGER->value              => PhpTypeEnum::INT->value,
                DoctrineTypeEnum::JSON->value                 => PhpTypeEnum::ARRAY->value, // Originally : 'mixed'
                DoctrineTypeEnum::SIMPLE_ARRAY->value         => PhpTypeEnum::ARRAY->value,
                DoctrineTypeEnum::SMALLINT->value             => PhpTypeEnum::INT->value,
                DoctrineTypeEnum::STRING->value               => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::TEXT->value                 => PhpTypeEnum::STRING->value,
                DoctrineTypeEnum::TIME->value                 => PhpTypeEnum::STRING->value, // Originally: '\DateTime'
                DoctrineTypeEnum::TIME_IMMUTABLE->value       => PhpTypeEnum::STRING->value, // Not present originally
                DoctrineTypeEnum::UNKNOWN->value              => PhpTypeEnum::UNKNOWN->value,
            ],

            'javascript' => [
                DoctrineTypeEnum::ASCII_STRING->value         => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::BIGINT->value               => JavaScriptTypeEnum::BIGINT->value,
                DoctrineTypeEnum::BINARY->value               => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::BLOB->value                 => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::BOOLEAN->value              => JavaScriptTypeEnum::BOOLEAN->value,
                DoctrineTypeEnum::DATE->value                 => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATE_IMMUTABLE->value       => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATEINTERVAL->value         => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATETIME->value             => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATETIME_IMMUTABLE->value   => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATETIMETZ->value           => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DATETIMETZ_IMMUTABLE->value => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::DECIMAL->value              => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::FLOAT->value                => JavaScriptTypeEnum::NUMBER->value,
                DoctrineTypeEnum::GUID->value                 => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::INTEGER->value              => JavaScriptTypeEnum::NUMBER->value,
                DoctrineTypeEnum::JSON->value                 => JavaScriptTypeEnum::OBJECT->value,
                DoctrineTypeEnum::SIMPLE_ARRAY->value         => JavaScriptTypeEnum::OBJECT->value,
                DoctrineTypeEnum::SMALLINT->value             => JavaScriptTypeEnum::NUMBER->value,
                DoctrineTypeEnum::STRING->value               => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::TEXT->value                 => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::TIME->value                 => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::TIME_IMMUTABLE->value       => JavaScriptTypeEnum::STRING->value,
                DoctrineTypeEnum::UNKNOWN->value              => JavaScriptTypeEnum::UNKNOWN->value,
            ],
        ],
    ],
];
