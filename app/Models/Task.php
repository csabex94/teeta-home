<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'daily',
        'push_email',
        'completed',
        'spec_date',
        'spec_time',
        'remind_before_value',
        'remind_before_option',
        'important'
    ];

    protected $dates = [
        'spec_date',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function colaborators() {
        return $this->hasOne(Collaboration::class, 'task_id', 'id');
    }
    
}
