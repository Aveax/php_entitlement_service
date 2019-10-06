<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class PPVServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\PPVRepositoryInterface',
            'App\Repositories\PPVRepository'
        );

        $this->app->bind(
            'App\Services\Interfaces\PPVServiceInterface',
            'App\Services\PPVService'
        );
    }
}
