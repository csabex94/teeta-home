<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getTasks(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\Task::class, 'user_id', 'id');
    }

    public function events() {
        return $this->hasMany(\App\Models\Event::class, 'event_id', 'id');
    }

    public function friends() {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->wherePivot('accepted', '=', 1);
    }

    public function colaborations() {
        return $this->hasMany(Collaboration::class, 'collaborations', 'user_id');
    }

    //public function notifications() {
        //return $this->hasMany(\App\Models\Notification::class);
    //}

    public function friendsOfMine() {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 1) // to filter only accepted
            ->withPivot('accepted'); // or to fetch accepted value
    }

    public function pendingFriendsOfMine() {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 0) // to filter only accepted
            ->withPivot('accepted'); // or to fetch accepted value
    }

    public function friendOf() {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->wherePivot('accepted', '=', 1)
            ->withPivot('accepted');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute() {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    protected function loadFriends() {
        if ( ! array_key_exists('friends', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends() {
        return $this->friendsOfMine->merge($this->friendOf)->merge($this->pendingFriendsOfMine);
    }
    /*
    // access all friends
    $user->friends; // collection of unique User model instances

    // access friends a user invited
    $user->friendsOfMine; // collection

    // access friends that a user was invited by
    $user->friendOf; // collection

    // and eager load all friends with 2 queries
    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();

    // then
    $users->first()->friends; // collection

    // Check the accepted value:
    $user->friends->first()->pivot->accepted;
    */
}
