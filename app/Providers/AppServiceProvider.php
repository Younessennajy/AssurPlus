<?php

namespace App\Providers;
use App\Models\Pays;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
        public function boot()
    {
        View::composer('admin.layouts.sidebar', function ($view) {
            $view->with('pays', Pays::all());
        });

        View::composer('layouts.sidebar', function ($view) {
            $view->with('pays', Pays::all());
        });
    }
}
