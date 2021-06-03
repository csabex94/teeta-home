<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'title',
        'description',
        'daily',
        'user_id',
        'spec_date',
        'spec_time',
        'push_email',
        'remind_before_option',
        'remind_before_value'
    ];

    protected $dates = [
        'spec_date',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
