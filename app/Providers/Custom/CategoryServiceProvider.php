<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository'
        );
    }
}
