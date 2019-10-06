<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class SVODServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\SVODRepositoryInterface',
            'App\Repositories\SVODRepository'
        );

        $this->app->bind(
            'App\Services\Interfaces\SVODServiceInterface',
            'App\Services\SVODService'
        );
    }
}
