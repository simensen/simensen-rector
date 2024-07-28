<?php

class One
{
    public function __construct(string $a = null, string $b)
    {
    }
}

class Two
{
    public function __construct(?string $a = null, string $b)
    {
    }
}

class Three
{
    public function __construct(
        string $a,
        string $b,
        string $c = null,
        string $d,
        string $e = null,
        string $f = null,
        string $g,
        string $h = null,
    )
    {
    }
}

class Four
{
    public function __construct(
        string $a,
        string $b,
        string $c = null,
        string $d,
        string $e = null,
        string $f = null,
        string $g,
        string $h = null,
        string $i = null,
        string $j = null,
    )
    {
    }
}

class Five
{
    public function __construct(
        string $a,
        string $b,
        ?string $c = null,
        string $d,
        string $e = null,
        ?string $f = null,
        string $g,
        string $h = null,
    )
    {
    }
}

class Six
{
    public function __construct(
        string $a,
        string $b,
        ?string $c = null,
        string $d,
        string $e = null,
        ?string $f = null,
        string $g,
        string $h = null,
        string $i = null,
        string $j = null,
    )
    {
    }
}

class Seven
{
    public function __construct(
        string $a = 'A',
        string $b,
        string $c = 'C',
    )
    {
    }
}

class Eight
{
    public function __construct(
        string $a = 'A',
        ?string $b,
        string $c = 'C',
    )
    {
    }
}

class Nine
{
    public function __construct(
        string|int $a = 'A',
        string|int $b,
        string|int $c = 'C',
    )
    {
    }
}

class Ten
{
    public function __construct(
        string|int $a = 'A',
        string|int|null $b,
        string|int $c = 'C',
    )
    {
    }
}

class Eleven
{
    public function __construct(
        string|int $a = 'A',
        string|int $b,
        string|int|null $c = 'C',
    )
    {
    }
}

class Twelve
{
    public function __construct(
        string|int $a = 'A',
        string|int|null $b,
        string|int|null $c = 'C',
    )
    {
    }
}

class TwoAlphaOne {
    public function __construct(string $a, string $b = null)
    {
    }
}

class TwoAlphaTwoAlpha {
    public function __construct(string $a = null, string $b = null)
    {
    }
}

class TwoBetaTwoAlpha {
    public function __construct(string $a = null, ?string $b = null)
    {
    }
}

class TwoAlphaTwoBeta {
    public function __construct(?string $a = null, string $b = null)
    {
    }
}

class UnionTwoAlphaOne {
    public function __construct(string|int $a, string|int $b = null)
    {
    }
}

class UnionTwoAlphaTwoAlpha {
    public function __construct(string|int $a = null, string|int $b = null)
    {
    }
}

class UnionTwoBetaTwoAlpha {
    public function __construct(string|int $a = null, string|int|null $b = null)
    {
    }
}

class UnionTwoAlphaTwoBeta {
    public function __construct(string|int|null $a = null, string|int $b = null)
    {
    }
}
-----
<?php

class One
{
    public function __construct(?string $a, string $b)
    {
    }
}

class Two
{
    public function __construct(?string $a, string $b)
    {
    }
}

class Three
{
    public function __construct(
        string $a,
        string $b,
        ?string $c,
        string $d,
        ?string $e,
        ?string $f,
        string $g,
        ?string $h = null,
    )
    {
    }
}

class Four
{
    public function __construct(
        string $a,
        string $b,
        ?string $c,
        string $d,
        ?string $e,
        ?string $f,
        string $g,
        ?string $h = null,
        ?string $i = null,
        ?string $j = null,
    )
    {
    }
}

class Five
{
    public function __construct(
        string $a,
        string $b,
        ?string $c,
        string $d,
        ?string $e,
        ?string $f,
        string $g,
        ?string $h = null,
    )
    {
    }
}

class Six
{
    public function __construct(
        string $a,
        string $b,
        ?string $c,
        string $d,
        ?string $e,
        ?string $f,
        string $g,
        ?string $h = null,
        ?string $i = null,
        ?string $j = null,
    )
    {
    }
}

class Seven
{
    public function __construct(
        string $a,
        string $b,
        string $c = 'C',
    )
    {
    }
}

class Eight
{
    public function __construct(
        string $a,
        ?string $b,
        string $c = 'C',
    )
    {
    }
}

class Nine
{
    public function __construct(
        string|int $a,
        string|int $b,
        string|int $c = 'C',
    )
    {
    }
}

class Ten
{
    public function __construct(
        string|int $a,
        string|int|null $b,
        string|int $c = 'C',
    )
    {
    }
}

class Eleven
{
    public function __construct(
        string|int $a,
        string|int $b,
        string|int|null $c = 'C',
    )
    {
    }
}

class Twelve
{
    public function __construct(
        string|int $a,
        string|int|null $b,
        string|int|null $c = 'C',
    )
    {
    }
}

class TwoAlphaOne {
    public function __construct(string $a, ?string $b = null)
    {
    }
}

class TwoAlphaTwoAlpha {
    public function __construct(?string $a = null, ?string $b = null)
    {
    }
}

class TwoBetaTwoAlpha {
    public function __construct(?string $a = null, ?string $b = null)
    {
    }
}

class TwoAlphaTwoBeta {
    public function __construct(?string $a = null, ?string $b = null)
    {
    }
}

class UnionTwoAlphaOne {
    public function __construct(string|int $a, string|int|null $b = null)
    {
    }
}

class UnionTwoAlphaTwoAlpha {
    public function __construct(string|int|null $a = null, string|int|null $b = null)
    {
    }
}

class UnionTwoBetaTwoAlpha {
    public function __construct(string|int|null $a = null, string|int|null $b = null)
    {
    }
}

class UnionTwoAlphaTwoBeta {
    public function __construct(string|int|null $a = null, string|int|null $b = null)
    {
    }
}
