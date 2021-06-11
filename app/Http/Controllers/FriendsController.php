<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Friend\FriendRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FriendsController extends Controller {

    protected $friend, $user;

    public function __construct(FriendRepositoryInterface $friend, User $user) {
        $this->friend = $friend;
        $this->user = $user;
    }
    
    public function index(Request $request) {
        $friends = auth()->user()->friends;
        
        $users = $this->user->where('id', '<>', auth()->user()->id)->get();
        $notFriends = [];

        foreach ($users as $user) {
            if(!$this->friend->isFriend(auth()->user()->id, $user->id)) {
                $notFriends[] = $user;
            }
        }
        return Inertia::render('Friends/Show', [
            'friends' => $friends,
            'users' => $notFriends
        ]);
    }

    public function sendFriendRequest(int $id) {
        return $this->friend->sendFriendRequest($id);
    }

    public function delete(Request $request) {
        $this->friend->deleteFriendRequest($request->id);
    }
}
