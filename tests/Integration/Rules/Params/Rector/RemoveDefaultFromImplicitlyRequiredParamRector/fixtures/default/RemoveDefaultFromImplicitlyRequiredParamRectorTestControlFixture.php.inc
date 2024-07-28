<?php

class One {
    public function __construct(string $a)
    {
    }
}

class Two {
    public function __construct(string $a, string $b)
    {
    }
}

class TwoBetaOne {
    public function __construct(string $a, ?string $b = null)
    {
    }
}

class TwoBetaTwoBeta {
    public function __construct(?string $a = null, ?string $b = null)
    {
    }
}

class Three {
    public function __construct(string $a, string $b, string $c)
    {
    }
}





class UnionOne {
    public function __construct(string|int $a)
    {
    }
}

class UnionTwo {
    public function __construct(string|int $a, string|int $b)
    {
    }
}

class UnionTwoBetaOne {
    public function __construct(string|int $a, string|int|null $b = null)
    {
    }
}

class UnionTwoBetaTwoBeta {
    public function __construct(string|int|null $a = null, string|int|null $b = null)
    {
    }
}

class UnionThree {
    public function __construct(string|int $a, string|int $b, string|int $c)
    {
    }
}
