<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        if (config('app.debug')) {
            DB::listen(function ($query) {
                Log::info($query->sql.' ['.$query->time.'] '.print_r($query->bindings, true));
            });
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
