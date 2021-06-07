<?php

namespace App\Repositories\Personal;

interface PersonalRepositoryInterface {
    public function get($id);
    public function getAll();
    public function store($request);
    public function update($request);
    public function delete($id);
    public function uploadImage($id, $fileObj);
}