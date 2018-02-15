<?php

namespace App\Providers;

use App\Infrastructure\Http\Middleware\LoggerNaive;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\HeaderComposer;
use Laravel\Dusk\DuskServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

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
        $this->app->singleton(LoggerInterface::class, function(){
            $log = new Logger('name');
            $stream_filepath = base_path('storage/logs/requests.log');
            $log->pushHandler(new StreamHandler($stream_filepath));
            return $log;
        });
    }
}
