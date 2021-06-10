<?php

namespace App\Repositories\Friend;

use Carbon\Carbon;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class FriendRepository implements FriendRepositoryInterface {
    
    protected $friend, $user;
    
    public function __construct(Friend $friend, User $user) {
        $this->friend = $friend;
        $this->user = $user;
    }

    public function getFriendsList() {
        
    }

    public function sendFriendRequest() {

    }

}