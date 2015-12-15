<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NameGenerator;

class NameGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\NameGenerator', function() {
           return new NameGenerator();
        });
    }
}
