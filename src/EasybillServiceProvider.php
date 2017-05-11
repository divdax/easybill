<?php

namespace DivDax\Easybill;

use Illuminate\Support\ServiceProvider;

class EasybillServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/easybill.php' => config_path('easybill.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton('easybill', function() {
            if(config('easybill.api_key') === null) {
                throw new \Exception('Missing easybill.de API-Key in config!');
            }
            return new easybill(config('easybill.api_key'));
        });
    }
}
