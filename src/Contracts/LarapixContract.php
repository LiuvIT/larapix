<?php

namespace Liuv\Larapix\Contracts;

use Liuv\Larapix\Contracts\Features\ChargesContract;

interface LarapixContract
{
    public function charges(): ChargesContract;
}