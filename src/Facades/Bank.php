<?php

namespace SimpleCMS\Bank\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SimpleCMS\Bank\Packages\Bank
 */
class Bank extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bank';
    }
}
