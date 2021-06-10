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
        $user = auth()->user()->id;
        if (!$request->username) {
            $friends = User::whereHas('friends', function($query) use ($user) {
                $query->where('user_id', '=', $user);
                })->get();
        } else {
            
        }
        dd($friends);
        return Inertia::render('Friends/Show', [
            'friends' => $friends
        ]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
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
        //
    }
}
