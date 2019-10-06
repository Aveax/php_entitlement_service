<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Services\Interfaces\SessionsServiceInterface',
            'App\Services\SessionsService'
        );
    }
}
