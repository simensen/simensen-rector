# Simensen Rector Rules

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Simensen's custom rules and tools for [Rector](https://github.com/rectorphp/rector) - a PHP automated refactoring tool.

## Installation

Install via Composer:

```bash
composer require simensen/rector
```

## Rules

### RemoveDefaultFromImplicitlyRequiredParamRector

This rector removes default values from function/method parameters when they are followed by required parameters, making the code more explicit and preventing potential runtime errors.

**What it does:**
- Removes default values from parameters that are implicitly required (have required parameters after them)
- Adds nullable types (`?type` or `|null`) to parameters that had `null` as their default value
- Preserves default values only for trailing optional parameters

**Example transformation:**

```php
// Before
class Example
{
    public function __construct(string $a = null, string $b)
    {
    }
}

// After  
class Example
{
    public function __construct(?string $a, string $b)
    {
    }
}
```

**More complex example:**

```php
// Before
public function method(
    string $a = 'default',
    string $b,
    string $c = null,
    string $d,
    string $e = 'end'
)

// After
public function method(
    string $a,
    string $b, 
    ?string $c,
    string $d,
    string $e = 'end'
)
```

## Usage

Add the rector to your `rector.php` configuration:

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Simensen\Rector\Rules\Params\Rector\RemoveDefaultFromImplicitlyRequiredParamRector;

return RectorConfig::configure()
    ->withRules([
        RemoveDefaultFromImplicitlyRequiredParamRector::class,
    ]);
```

Then run Rector:

```bash
vendor/bin/rector process src/
```

## Development

### Requirements

- PHP 8.1+
- Composer

### Setup

```bash
# Install dependencies
make vendor

# Install development tools
make tools
```

### Testing

```bash
# Run tests
make test

# Run code style checks and fixes
make cs
```

### Available Make Targets

- `make it` - Default target, installs tools and dependencies
- `make vendor` - Install Composer dependencies
- `make tools` - Install development tools via PHIVE
- `make test` - Run PHPUnit tests
- `make cs` - Run code style checks and fixes
- `make clean` - Remove vendor and tools directories
- `make realclean` - Clean and also remove composer.lock
- `make help` - Display available targets

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for any new functionality
5. Ensure all tests pass: `make test`
6. Ensure code style is correct: `make cs`
7. Submit a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author

**Beau Simensen** - [GitHub](https://github.com/simensen)