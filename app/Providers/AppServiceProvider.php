<?php

namespace App\Providers;

use App\Repositories\MealRepository\MealRespository;
use App\Repositories\MealRepository\MealRespositoryInterface;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(MealRespositoryInterface::class, MealRespository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

    }
}
