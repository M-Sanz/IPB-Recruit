<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrap();
        Gate::define('admin', function (User $user) {
            return $user->role === 'Admin';
        });
        Gate::define('student', function (User $user) {
            return $user->role === 'Mahasiswa';
        });
        Gate::define('organization', function (User $user) {
            return $user->role === 'Organisasi';
        });
    }
}
