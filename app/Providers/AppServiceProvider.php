<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

        $this->registerBladeDirectives();
    }


    protected function registerBladeDirectives() {

        Blade::directive('gravatar', function($email) {
            return "<?php echo 'http://www.gravatar.com/avatar/'.md5{$email}.'?s=90'; ?>";
        });

        Blade::directive('class', function($array) {
            return "<?php echo Html::classes{$array}; ?>";
        });

        Blade::directive('err_class', function($field) {
            return "<?php echo \$errors->has{$field} ? 'has-error' : '' ?>";
        });

        Blade::directive('err_block', function($field) {
            return "<?php echo \$errors->has{$field} ? '<span class=\"help-block\">'.\$errors->first{$field}.'</span>' : ''; ?>";
        });

        Blade::directive('selected', function($condition) {
            return "<?php echo {$condition}? 'selected' : '' ?>";
        });

        Blade::directive('checked', function($condition) {
            return "<?php echo {$condition}? 'checked' : '' ?>";
        });

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
