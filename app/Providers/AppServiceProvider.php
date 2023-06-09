<?php

namespace App\Providers;

use App\Models\LiqPayService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LiqPayService::class, function(Application $a){
            return (new LiqPayService())->setContext(config('app.liqpay_public_key'),config('app.liqpay_private_key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
