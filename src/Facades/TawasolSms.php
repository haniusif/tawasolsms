<?php

namespace Haniusif\TawasolSms\Facades;

use Illuminate\Support\Facades\Facade;

class TawasolSms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Haniusif\TawasolSms\TawasolSms::class;
    }
}
