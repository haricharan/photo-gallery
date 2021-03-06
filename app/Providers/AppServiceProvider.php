<?php

namespace PhotoGallery\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            // $this->app->register('Way\Generators\GeneratorsServiceProvider');
            $this->app->register('Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider');
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');

            // register an alias
            $this->app->booting(function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
            });
        }
    }
}
