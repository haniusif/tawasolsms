<?php

namespace Haniusif\TawasolSms;

use Illuminate\Support\ServiceProvider;

class TawasolSmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the configuration file, so it uses the package's default configuration if it's not published
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tawasolsms.php', 'tawasolsms'
        );

        // Register the singleton instance of TawasolSms
        $this->app->singleton(TawasolSms::class, function () {
            return new TawasolSms();
        });
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the configuration file to the user's config directory
        $this->publishes([
            __DIR__ . '/../config/tawasolsms.php' => config_path('tawasolsms.php'),
        ], 'config');
    }
}
