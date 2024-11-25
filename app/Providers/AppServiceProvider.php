<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Validator;
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
    public function boot(): void
    {
        View::composer('livewire.admin.layouts.sidebar', function ($view) {
            $view->with('pays', \App\Models\Pays::all());
        });

        View::composer('layouts.sidebar', function ($view) {
            $view->with('pays', \App\Models\Pays::all());
        });

        Validator::extend('unique_column', function ($attribute, $value, $parameters, $validator) {
            $table = $parameters[0] ?? null;

            if (!$table || !Schema::hasTable($table)) {
                return false;
            }

            return !Schema::hasColumn($table, $value);
        }, 'La colonne existe déjà.');
    }
}
