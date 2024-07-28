<?php

declare(strict_types=1);

use Rector\Config;
use Simensen\Rector\Rules;

return static function (Config\RectorConfig $rectorConfig): void {
    $rectorConfig->rule(Rules\Params\Rector\RemoveDefaultFromImplicitlyRequiredParamRector::class);
};
