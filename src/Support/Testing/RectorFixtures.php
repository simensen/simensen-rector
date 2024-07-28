<?php

declare(strict_types=1);

namespace Simensen\Rector\Support\Testing;

use PHPUnit\Framework\Attributes\DataProvider;

trait RectorFixtures
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): iterable
    {
        return self::yieldFilesFromDirectory(self::getFixturePath());
    }

    private static function getTestFileName(): string
    {
        $reflectionClass = new \ReflectionClass(static::class);

        return $reflectionClass->getFileName();
    }

    private static function getTestBaseDir(): string
    {
        return dirname(self::getTestFileName());
    }

    private static function getTestBasename(): string
    {
        return basename(self::getTestBaseDir());
    }

    private static function getConfigurationName(): string
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $attributes = $reflectionClass->getAttributes(FixtureConfiguration::class);

        return (count($attributes) > 0 ? $attributes[0]->newInstance() : new FixtureConfiguration())
            ->name;
    }

    private static function getFixturePath(?string $path = null): string
    {
        return sprintf(
            '%s/fixtures/%s%s',
            self::getTestBaseDir(),
            self::getConfigurationName(),
            isset($path) ? sprintf('/%s', ltrim($path, '/')) : '',
        );
    }

    public function provideConfigFilePath(): string
    {
        return self::getFixturePath(sprintf(
            'config/%s.rector-config.php',
            self::getConfigurationName(),
        ));
    }
}
