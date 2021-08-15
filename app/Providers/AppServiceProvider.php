<?php

namespace App\Providers;

use App\Contracts\Filter\FilterInterface;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Services\Filters\BookFilterService;
use App\Services\Filters\UserFilterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FilterInterface::class, function ($app) {
            if (request()->has('userFilter')) {
                return $app->make(UserFilterService::class);
            }
            if (request()->has('bookFilter')) {
                return $app->make(BookFilterService::class);
            }
            return $app->make(BookFilterService::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
