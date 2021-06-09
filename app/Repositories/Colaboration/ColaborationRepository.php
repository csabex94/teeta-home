<?php

namespace App\Repositories\Colaboration;

use Carbon\Carbon;
use App\Models\Colaboration;
use Illuminate\Support\Facades\Session;

class ColaborationRepository implements ColaborationRepositoryInterface {
    
    protected $colaboration;
    
    public function __construct(Colaboration $colaboration) {
        $this->colaboration = $colaboration;
    }

}