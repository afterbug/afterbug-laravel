<?php

namespace AfterBug\AfterBugLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class AfterBug extends Facade
{
    /**
     * Get facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'afterbug';
    }
}
