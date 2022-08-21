<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Contracts\Types;

use VicGutt\InspectDb\Types\PhpTypeEnum;
use Doctrine\DBAL\Types\Type as DoctrineType;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;

interface TypeEnumContract
{
    public static function fromDoctrineType(DoctrineType $type): self;

    public static function fromString(string $type): self;

    public static function fromPhp(PhpTypeEnum $type): self;

    public static function fromJavascript(JavaScriptTypeEnum $type): self;

    public function toPhp(): PhpTypeEnum;

    public function toJavascript(): JavaScriptTypeEnum;

    public function raw(): ?string;
}
