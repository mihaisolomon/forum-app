<?php

namespace App\Providers;

use App\Repositories\Threads\ThreadRepository;
use App\Repositories\Threads\ThreadRepositoryInterface;
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
        $this->app->singleton(
            ThreadRepositoryInterface::class,
            ThreadRepository::class
        );

        $this->app->bind(
            \Laravel\Cashier\Http\Controllers\PaymentController::class,
            \App\Http\Controllers\PaymentController::class
        );
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
