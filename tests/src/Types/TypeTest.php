<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\JsonType;
use VicGutt\InspectDb\Types\Type;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\DateTimeType;
use VicGutt\InspectDb\Types\PhpTypeEnum;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use VicGutt\InspectDb\Types\JavaScriptTypeEnum;

$toArrayExamples = [
    // PHP types
    'null' => ['value' => 'null', 'php' => 'null', 'javascript' => 'null'],
    'bool' => ['value' => 'bool', 'php' => 'bool', 'javascript' => 'boolean'],
    'int' => ['value' => 'int', 'php' => 'int', 'javascript' => 'number'],
    'float' => ['value' => 'float', 'php' => 'float', 'javascript' => 'number'],
    'string' => ['value' => 'string', 'php' => 'string', 'javascript' => 'string'],
    'array' => ['value' => 'array', 'php' => 'array', 'javascript' => 'object'],
    'object' => ['value' => 'object', 'php' => 'object', 'javascript' => 'object'],
    'resource' => ['value' => 'resource', 'php' => 'resource', 'javascript' => 'object'],
    'unknown' => ['value' => 'unknown', 'php' => null, 'javascript' => null],

    // JavaScript types
    'null' => ['value' => 'null', 'php' => 'null', 'javascript' => 'null'],
    'undefined' => ['value' => 'undefined', 'php' => 'null', 'javascript' => 'undefined'],
    'boolean' => ['value' => 'boolean', 'php' => 'bool', 'javascript' => 'boolean'],
    'number' => ['value' => 'number', 'php' => 'int', 'javascript' => 'number'],
    'string' => ['value' => 'string', 'php' => 'string', 'javascript' => 'string'],
    'symbol' => ['value' => 'symbol', 'php' => 'string', 'javascript' => 'symbol'],
    'bigint' => ['value' => 'bigint', 'php' => 'string', 'javascript' => 'bigint'],
    'object' => ['value' => 'object', 'php' => 'object', 'javascript' => 'object'],
    'unknown' => ['value' => 'unknown', 'php' => null, 'javascript' => null],

    // Random types,
    'INT' => ['value' => 'INT', 'php' => null, 'javascript' => null],
    'NUMBER' => ['value' => 'NUMBER', 'php' => null, 'javascript' => null],
    'unknown' => ['value' => 'unknown', 'php' => null, 'javascript' => null],
    'nope' => ['value' => 'nope', 'php' => null, 'javascript' => null],
];

it('implements `Illuminate\Contracts\Support\Arrayable`', function (): void {
    expect(is_subclass_of(Type::class, Arrayable::class))->toEqual(true);
});

it('implements `Illuminate\Contracts\Support\Jsonable`', function (): void {
    expect(is_subclass_of(Type::class, Jsonable::class))->toEqual(true);
});

it('implements `JsonSerializable`', function (): void {
    expect(is_subclass_of(Type::class, JsonSerializable::class))->toEqual(true);
});

it('implements `Stringable`', function (): void {
    expect(is_subclass_of(Type::class, Stringable::class))->toEqual(true);
});

it('Type::make()', function (): void {
    expect(Type::make(new BigIntType())->value)->toEqual('bigint');
    expect(Type::make(new DateTimeType())->value)->toEqual('datetime');
    expect(Type::make(new JsonType())->value)->toEqual('json');

    expect(Type::make('bigint')->value)->toEqual('bigint');
    expect(Type::make('datetime')->value)->toEqual('datetime');
    expect(Type::make('json')->value)->toEqual('json');

    expect(Type::make('nope')->value)->toEqual('nope');
});

it('Type::fromDoctrineType()', function (): void {
    expect(Type::make(new BigIntType())->value)->toEqual('bigint');
    expect(Type::make(new DateTimeType())->value)->toEqual('datetime');
    expect(Type::make(new JsonType())->value)->toEqual('json');
});

it('Type::toPhp()', function (): void {
    expect(Type::make('null')->toPhp())->toEqual(PhpTypeEnum::NULL->value);
    expect(Type::make('bool')->toPhp())->toEqual(PhpTypeEnum::BOOL->value);
    expect(Type::make('int')->toPhp())->toEqual(PhpTypeEnum::INT->value);
    expect(Type::make('float')->toPhp())->toEqual(PhpTypeEnum::FLOAT->value);
    expect(Type::make('string')->toPhp())->toEqual(PhpTypeEnum::STRING->value);
    expect(Type::make('array')->toPhp())->toEqual(PhpTypeEnum::ARRAY->value);
    expect(Type::make('object')->toPhp())->toEqual(PhpTypeEnum::OBJECT->value);
    expect(Type::make('resource')->toPhp())->toEqual(PhpTypeEnum::RESOURCE->value);
    expect(Type::make('unknown')->toPhp())->toEqual(null);
    expect(Type::make('nope')->toPhp())->toEqual(null);
});

it('Type::toJavascript()', function (): void {
    expect(Type::make('null')->toJavascript())->toEqual(JavaScriptTypeEnum::NULL->value);
    expect(Type::make('undefined')->toJavascript())->toEqual(JavaScriptTypeEnum::UNDEFINED->value);
    expect(Type::make('boolean')->toJavascript())->toEqual(JavaScriptTypeEnum::BOOLEAN->value);
    expect(Type::make('number')->toJavascript())->toEqual(JavaScriptTypeEnum::NUMBER->value);
    expect(Type::make('string')->toJavascript())->toEqual(JavaScriptTypeEnum::STRING->value);
    expect(Type::make('symbol')->toJavascript())->toEqual(JavaScriptTypeEnum::SYMBOL->value);
    expect(Type::make('bigint')->toJavascript())->toEqual(JavaScriptTypeEnum::BIGINT->value);
    expect(Type::make('object')->toJavascript())->toEqual(JavaScriptTypeEnum::OBJECT->value);
    expect(Type::make('unknown')->toJavascript())->toEqual(null);
    expect(Type::make('nope')->toJavascript())->toEqual(null);
});

it('Type::toArray()', function () use ($toArrayExamples): void {
    foreach ($toArrayExamples as $type => $example) {
        expect(Type::make($type)->toArray())->toEqual($example);
    }
});

it('Type::toJson()', function () use ($toArrayExamples): void {
    foreach ($toArrayExamples as $type => $example) {
        expect(Type::make($type)->toJson())->toEqual(json_encode($example));
    }
});

it('Type::jsonSerialize()', function () use ($toArrayExamples): void {
    foreach ($toArrayExamples as $type => $example) {
        expect(Type::make($type)->jsonSerialize())->toEqual($example);
    }
});

it('Type::__toString()', function () use ($toArrayExamples): void {
    foreach ($toArrayExamples as $type => $example) {
        expect((string) Type::make($type))->toEqual(json_encode($example));
    }
});
