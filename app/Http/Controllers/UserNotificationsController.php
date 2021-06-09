<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller {
    
    public function __construct() {
        
    }

    public function show() {
        return Inertia::render('Notifications', [
            'notifications' => auth()->user()->unreadNotifications()->latest()->paginate()
        ]);
    }
}
