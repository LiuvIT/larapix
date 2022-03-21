<?php

namespace Liuv\Larapix;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Liuv\Larapix\Contracts\LarapixContract;

class LarapixServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/larapix.php' => config_path('larapix.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->bind(LarapixContract::class, function () {
            $client = new Client([
                'base_uri' => config('larapix.base_url'),
                'headers' => [
                    'Authorization' => config('larapix.app_id')
                ]
            ]);

            return new LarapixService($client);
        });
    }
}
