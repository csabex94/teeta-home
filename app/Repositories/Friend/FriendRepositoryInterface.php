<?php

namespace App\Repositories\Friend;

interface FriendRepositoryInterface {

    public function getFriendsList();
    public function sendFriendRequest($id);
    public function befriend($id);
    public function deleteFriendRequest($id);
    public function unfriend($id);
}