<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;

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
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        Schema::defaultStringLength(191);

        Gate::define('isAdmin', function(User $user) {
            return $user->is_admin == 1;
        });

        Gate::define('isUser', function(User $user) {
            return $user->is_admin == 0;
        });
    }
}
