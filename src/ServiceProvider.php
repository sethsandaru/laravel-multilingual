<?php


namespace SethPhat\Multilingual;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\App;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes.php");
        $this->loadViewsFrom(__DIR__ . "/views", "multilingual");
        $this->loadTranslationsFrom(__DIR__ . "/translations", "multilingual");

        $this->publishes([
            __DIR__.'/configs/multilingual.php' => config_path('multilingual.php'),
            __DIR__.'/../assets' => public_path('vendor/multilingual')
        ], 'multilingual');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('multilingual', function() {
            return new \SethPhat\Multilingual\Libraries\TextBundleHandler;
        });

        $this->mergeConfigFrom(__DIR__.'/configs/multilingual.php', 'multilingual');
    }
}