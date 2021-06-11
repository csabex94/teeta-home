<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user) {
        $this->user = $user;
    }

    public function getOnlineUsers()
    {
        return response()->json($this->user->onlineUsers());
    }
}
