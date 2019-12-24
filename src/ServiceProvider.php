<?php


namespace SethPhat\Multilingual;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\App;
use SethPhat\Multilingual\Libraries\Events\LanguageCreated;
use SethPhat\Multilingual\Libraries\Events\LanguageRemoved;
use SethPhat\Multilingual\Libraries\Listeners\AppendLangTextListener;
use SethPhat\Multilingual\Libraries\Listeners\RemoveLangTextListener;
use Illuminate\Support\Facades\Event;

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

        // Manually register my own event for this package development
        Event::listen(LanguageCreated::class, AppendLangTextListener::class);
        Event::listen(LanguageRemoved::class, RemoveLangTextListener::class);
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