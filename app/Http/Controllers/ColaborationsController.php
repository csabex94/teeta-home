<?php

namespace App\Http\Controllers;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColaborationsController extends Controller {
    
    protected $task, $event;

    public function __construct(TaskRepositoryInterface $task, EventRepositoryInterface $event, ) {
        $this->task = $task;
        $this->event = $event;
    }

    public function index() {
        //
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
