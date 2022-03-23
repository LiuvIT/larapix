<?php

namespace Liuv\Larapix\Facades;

use Illuminate\Support\Facades\Facade;

class Larapix extends Facade
{
    /**
     * Get registered facade block
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'larapix';
    }
}
