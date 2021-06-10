<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Collaboration extends Model {

    use Notifiable;

    public function users() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function complete() {
        $this->completed = 1;
        $this->save();
    }

}