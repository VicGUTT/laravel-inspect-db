<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Contracts\Types;

use VicGutt\InspectDb\Types\PhpTypeEnum;
use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\InspectDb\Types\DoctrineTypeEnum;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;
use VicGutt\PhpEnhancedEnum\Contracts\EnumerableContract;

interface TypeEnumContract extends EnumerableContract
{
    public static function fromDoctrine(DoctrineType|DoctrineTypeEnum $type): self;

    public static function fromString(string $type): self;

    public static function fromPhp(PhpTypeEnum $type): self;

    public static function fromJavascript(JavaScriptTypeEnum $type): self;

    public function toPhp(): PhpTypeEnum;

    public function toJavascript(): JavaScriptTypeEnum;

    public function raw(): ?string;
}
