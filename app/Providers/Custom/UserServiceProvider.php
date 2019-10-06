<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }
}
