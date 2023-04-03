<?php

namespace App\Providers;

use App\Youtube\YoutubeServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('App\Youtube\YoutubeServices', function () {
            // dd('hello', env('YOUTUBE_API_KEY'));
            return new YoutubeServices(env('YOUTUBE_API_KEY'));
        });
    }
}
