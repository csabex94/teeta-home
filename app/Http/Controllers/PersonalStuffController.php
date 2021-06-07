<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Repositories\Personal\PersonalRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalStuffController extends Controller {

    protected $personal, $user;
    
    public function __construct(PersonalRepositoryInterface $personal) {
        $this->personal = $personal;
    }

    public function show() {
        return Inertia::render('Personal/Show', [
            'items' => $this->personal->getAll()
        ]);
    }

    public function create() {
        return Inertia::render('Personal/Create');
    }

    public function store(Request $request) {
        $this->personal->store($request);

        return redirect()->route('personal.show')->with('success', 'Personal record added.');
    }

    public function edit(Personal $personal) {
        return Inertia::render('Personal/Edit', $personal);
    }

    public function update(Request $request) {
        $this->personal->update($request);

        return redirect()->route('personal.show')->with('success', 'Personal record updated.');
    }

    public function delete(Request $request) {
        $this->personal->delete($request->id);

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

}