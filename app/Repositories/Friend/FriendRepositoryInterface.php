<?php

namespace App\Repositories\Friend;

interface FriendRepositoryInterface {

    public function getFriendsList();
    public function searchFriends($search);
    public function isFriend($user, $friend);
    public function sendFriendRequest($id);
    public function befriend($id);
    public function deleteFriendRequest($id);
}