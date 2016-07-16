<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Repos\Contracts\Access::class, function ($app) {
            return new \App\Repos\Access;
        });

        $this->app->singleton(\App\Repos\Contracts\User::class, function ($app) {
            return new \App\Repos\User;
        });

        $this->app->singleton(\App\Repos\Contracts\Project::class, function ($app) {
            return new \App\Repos\Project(app(\App\Repos\Contracts\Access::class));
        });
    }
}
