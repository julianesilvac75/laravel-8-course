<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * A Facade to contracts
 * @method static int increment(string $key, array $tags = null)
 */

class CounterFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'App\Contracts\CounterContract';
    }
}