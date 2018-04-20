<?php

namespace AfterBug\AfterBugLaravel\Callbacks;

use AfterBug\Config;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Execute user callback.
     *
     * @param Config $config
     * @return void
     */
    public function __invoke(Config $config)
    {
        if (Auth::check()) {
            $config->setUser(
                Auth::user()->toArray()
            );
        }
    }
}
