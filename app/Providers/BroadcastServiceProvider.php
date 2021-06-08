<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes(['middleware' => ['auth:api']]);

        Broadcast::channel('App.User.*', function ($user, $userId) {
            return true;
        });

        require base_path('routes/channels.php');
    }
}
