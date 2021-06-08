<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model {
    
    use HasFactory;
    
    protected $guarded = [];

    protected $dates = [
        'spec_date',
        'created_at',
        'updated_at'
    ];

    public $table = 'personal_items';
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

}