<?php

namespace App\Repositories\Friend;

use App\Mail\FriendRequest;
use Carbon\Carbon;
use App\Models\Friend;
use App\Models\User;
use App\Notifications\SendFriendRequest;

class FriendRepository implements FriendRepositoryInterface {
    
    protected $friend, $user;
    
    public function __construct(Friend $friend, User $user) {
        $this->friend = $friend;
        $this->user = $user;
    }

    public function getFriendsList() {
        return auth()->user()->friends;
    }

    public function sendFriendRequest($id) {
        $user = $this->user->find($id)->first(); //get friend id

        if($this->befriend($user)) { //create friendship
            event(new FriendRequest($user, auth()->user())); //send a mail
        }

        $user->notify(new SendFriendRequest(auth()->user())); //send a notification to that user
        $this->friend->user_id = auth()->user()->id;
        $this->friend->friend_id = $user->id;
        $this->friend->save();

    }

    public function befriend($user) {
        $this->friend->user_id = auth()->user()->id;
        $this->friend->friend_id = $user->id;
        $this->friend->save();

        return true;
    }

    public function unfriend($id) {
        $friendship = $this->friend->where('friend_id', $id)->where('user_id', auth()->user()->id)->first();
        $friendship->delete();

        return true;
    }
    
    public function deleteFriendRequest($id) {
        $friendship = $this->friend->find($id);
        $friendship->delete();

        //event(new DeclineFriendRequest($toUser), auth()->user());
    }

}