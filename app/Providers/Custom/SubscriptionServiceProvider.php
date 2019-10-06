<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\SubscriptionRepositoryInterface',
            'App\Repositories\SubscriptionRepository'
        );
    }
}
