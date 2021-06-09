<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191); //fix migration errors (keys too long)
        $this->app->bind('App\Repositories\Colaboration\ColaborationRepositoryInterface', 'App\Repositories\Colaboration\ColaborationRepository');
        $this->app->bind('App\Repositories\Event\EventRepositoryInterface', 'App\Repositories\Event\EventRepository');
        $this->app->bind('App\Repositories\Task\TaskRepositoryInterface', 'App\Repositories\Task\TaskRepository');
        $this->app->bind('App\Repositories\Personal\PersonalRepositoryInterface', 'App\Repositories\Personal\PersonalRepository');
    }
}
