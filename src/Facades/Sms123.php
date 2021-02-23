<?php

namespace Cyaoz94\Sms123\Facades;

use Illuminate\Support\Facades\Facade;

class Sms123 extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sms123';
    }
}
