<?php

namespace App\Providers;

use App\Http\Services\Quote;
use App\Http\Services\QuoteAPI;
use App\Http\Services\QuoteCache;
use App\Http\Services\QuoteFake;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\HeaderComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setLocale(LC_TIME, config('app.locale'));

        view()->composer('front/layout',MenuComposer::class);

        view()->composer('back/layout',HeaderComposer::class);

        Blade::if('admin', function () {
            return auth()->user()->role === 'admin';
        });

        Blade::if('redac', function () {
            return auth()->user()->role === 'redac';
        });

        Blade::if('request', function ($url) {
            return request()->is($url);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'testing') {
            $this->app->singleton(Quote::class, QuoteFake::class);
        } else {
            $this->app->singleton(Quote::class, function(){
                return new QuoteCache(
                    new QuoteAPI(
                        new Client()
                    )
                );
            });
        }
    }
}
