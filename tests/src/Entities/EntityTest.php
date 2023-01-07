<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use VicGutt\InspectDb\Entities\Entity;
use Doctrine\DBAL\Schema\AbstractAsset;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

final class Child extends Entity
{
    public function __construct(public readonly int $id, public string $name, public Collection $data)
    {
    }

    public function schema(): AbstractAsset
    {
        return new class () extends AbstractAsset {
        };
    }
}

$item = [
    'id' => 1,
    'name' => 'the child',
    'data' => [1, 2, 3],
];
$params = [
    ...$item,
    'data' => collect($item['data']),
];

it('implements `ArrayAccess`', function (): void {
    expect(is_subclass_of(Entity::class, ArrayAccess::class))->toEqual(true);
});

it('implements `JsonSerializable`', function (): void {
    expect(is_subclass_of(Entity::class, JsonSerializable::class))->toEqual(true);
});

it('implements `Illuminate\Contracts\Support\Arrayable`', function (): void {
    expect(is_subclass_of(Entity::class, Arrayable::class))->toEqual(true);
});

it('implements `Illuminate\Contracts\Support\Jsonable`', function (): void {
    expect(is_subclass_of(Entity::class, Jsonable::class))->toEqual(true);
});

it('implements `Stringable`', function (): void {
    expect(is_subclass_of(Entity::class, Stringable::class))->toEqual(true);
});

it('uses `Illuminate\Support\Traits\Macroable`', function (): void {
    expect(in_array(Macroable::class, class_uses(Entity::class), true))->toEqual(true);
});

it('returns an array containing the objects public properties when `toArray()` is called', function () use ($item, $params): void {
    $child = new Child(...$params);

    expect($child->toArray())->toEqual($item);
});

it('returns a json version of the returned value of `toArray()` when `toJson()` is called', function () use ($item, $params): void {
    $child = new Child(...$params);

    expect($child->toJson())->toEqual(json_encode($item));
});

it('returns a json version of the returned value of `toArray()` when json encoded', function () use ($item, $params): void {
    $child = new Child(...$params);

    expect(json_encode($child))->toEqual(json_encode($item));
});

it('returns a json version of the returned value of `toArray()` when turned into a string', function () use ($item, $params): void {
    $child = new Child(...$params);

    expect((string) $child)->toEqual(json_encode($item));
});

it('can be used as an array | offsetExists - __isset', function () use ($params): void {
    $child = new Child(...$params);

    expect(isset($child['id']))->toEqual(true);
    expect(isset($child['nope']))->toEqual(false);

    expect(!empty($child['id']))->toEqual(true);
    expect(!empty($child['nope']))->toEqual(false);
});

it('can be used as an array | offsetGet', function () use ($params): void {
    $child = new Child(...$params);

    expect($child['id'])->toEqual(1);
    expect($child['name'])->toEqual('the child');
    expect(static fn () => $child['nope'])->toThrow(ErrorException::class, 'Undefined property: Child::$nope');
});

it('can be used as an array | offsetSet', function () use ($params): void {
    $child = new Child(...$params);

    expect(static fn () => $child['id'] = 2)->toThrow(Error::class, 'Cannot modify readonly property Child::$id');

    $child['name'] = 'changed';

    expect($child['name'])->toEqual('changed');

    $child['nope'] = 'yep';

    expect($child['nope'])->toEqual('yep');
});

it('can be used as an array | offsetUnset - __unset', function () use ($params): void {
    $child = new Child(...$params);

    expect(static function () use ($child): void {
        unset($child['id']);
    })->toThrow(Error::class, 'Cannot unset readonly property Child::$id');

    $child['nope'] = 'yep';

    expect($child['nope'])->toEqual('yep');

    unset($child['nope']);

    expect(isset($child['nope']))->toEqual(false);

    unset($child['name']);

    /**
     * Here, it returns `true` as `name` is still actually
     * a property of `$child`. And since the underlaying
     * `__isset` and `offsetExists` methods only check for
     * the property existant on the object, then this returns
     * the correct value.
     *
     * It is unintuative and wierd that I'm leaving things
     * like this for sure, but, it's an edge case we should
     * never actually encounter as all `Entity` subclasses
     * will/should always have their properties marked as readonly.
     */
    expect(isset($child['name']))->toEqual(true);

    /**
     * The following tests are to proove the above comments.
     */
    expect(property_exists($child, 'name'))->toEqual(true);

    $properties = (new ReflectionClass($child))->getProperties(ReflectionProperty::IS_PUBLIC);
    expect(
        array_map(
            static fn (ReflectionProperty $prop): string => $prop->getName(),
            $properties,
        ),
    )->toEqual(['id', 'name', 'data']);

    // The property's value is unset but not the property itself.
    expect(static fn () => $child->name)->toThrow(
        Error::class,
        'Typed property Child::$name must not be accessed before initialization',
    );
});
