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
     * The event listener mappings for the application.
     * **MUST**
     * @var array
     */
    protected $listen = [
        LanguageCreated::class => [
            AppendLangTextListener::class,
        ],

        LanguageRemoved::class => [
            RemoveLangTextListener::class,
        ],
    ];

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
        // BASED ON: https://github.com/laravel/framework/blob/5.5/src/Illuminate/Foundation/Support/Providers/EventServiceProvider.php
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
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