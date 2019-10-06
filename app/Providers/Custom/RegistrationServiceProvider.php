<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class RegistrationServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Services\Interfaces\RegistrationServiceInterface',
            'App\Services\RegistrationService'
        );
    }
}
