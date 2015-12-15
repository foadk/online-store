<?php

namespace App\Providers;

use App\Services\InterventionImageEditor;
use Illuminate\Support\ServiceProvider;

class ImageEditorServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Services\ImageEditorInterface', function() {
            return new InterventionImageEditor();
        });
    }
}
