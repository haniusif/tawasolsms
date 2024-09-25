<?php

namespace Haniusif\TawasolSms;

use Illuminate\Support\ServiceProvider;

class TawasolSmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TawasolSms::class, function () {
            return new TawasolSms();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/tawasolsms.php' => config_path('tawasolsms.php'),
        ], 'config');
    }
}
