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
        if (!$request->search) {
            $friends = auth()->user()->friends;
        } else {
            $friends = $this->user->where('username', 'LIKE', "%$request->search%")->orWhere('name', 'LIKE', "%$request->search%")->get();
        }
        
        return Inertia::render('Friends/Show', [
            'friends' => $friends
        ]);
    }

    public function sendFriendRequest(int $id) {
        return $this->friend->sendFriendRequest($id);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        $this->friend->deleteFriendRequest($id);
    }
}
