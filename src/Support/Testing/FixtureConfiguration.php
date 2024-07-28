<?php

declare(strict_types=1);

namespace Simensen\Rector\Support\Testing;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class FixtureConfiguration
{
    public const NAME_DEFAULT = 'default';

    public function __construct(public string $name = self::NAME_DEFAULT)
    {
    }
}
