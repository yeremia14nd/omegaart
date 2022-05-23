<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('superadmin', function (User $user) {
            return $user->is_role === '1';
        });

        Gate::define('admin', function (User $user) {
            return $user->is_role === '2';
        });

        Gate::define('estimator', function (User $user) {
            return $user->is_role === '3';
        });

        Gate::define('teknisi', function (User $user) {
            return $user->is_role === '4';
        });
    }
}
