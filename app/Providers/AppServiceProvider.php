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
        view()->composer('*', function ($view) {
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}
