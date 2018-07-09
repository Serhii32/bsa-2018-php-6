<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\CurrencyRepositoryInterface;
use App\Services\CurrencyRepository;
use App\Services\CurrencyGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

         $this->app->bind(CurrencyRepositoryInterface::class , function (){
           return new  CurrencyRepository(CurrencyGenerator::generate());
        });

    }
}
