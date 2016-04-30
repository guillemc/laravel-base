<?php

namespace App\Providers;

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
        if ($this->app['request']->segment(1) == 'admin') {
            $this->app['config']['auth.defaults.guard'] = 'back';
        } else {
            $this->app['config']['auth.defaults.guard'] = 'front';
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
