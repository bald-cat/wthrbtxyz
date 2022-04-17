<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TelegramMessage extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'message';
    }

}
