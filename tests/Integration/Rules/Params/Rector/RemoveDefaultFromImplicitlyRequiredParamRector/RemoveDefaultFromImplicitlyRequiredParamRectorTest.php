<?php

declare(strict_types=1);

namespace Simensen\Rector\Tests\Integration\Rules\Params\RemoveDefaultFromImplicitlyRequiredParamRector;

use PHPUnit\Framework\Attributes\CoversClass;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Simensen\Rector\Rules\Params\RemoveDefaultFromImplicitlyRequiredParamRector;
use Simensen\Rector\Support\Testing\FixtureConfiguration;
use Simensen\Rector\Support\Testing\RectorFixtures;

#[CoversClass(RemoveDefaultFromImplicitlyRequiredParamRector::class)]
#[FixtureConfiguration('default')]
class RemoveDefaultFromImplicitlyRequiredParamRectorTest extends AbstractRectorTestCase
{
    use RectorFixtures;
}
