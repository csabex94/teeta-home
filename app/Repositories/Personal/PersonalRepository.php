<?php

namespace App\Repositories\Personal;

use Carbon\Carbon;
use App\Models\Personal;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class PersonalRepository implements PersonalRepositoryInterface {
    
    protected $personal, $image;

    public function __construct(Personal $personal, Image $image) {
        $this->personal = $personal;
        $this->image = $image;
    }

    public function get($id) {
        return $this->personal->get($id)->first();
    }

    public function getAll() {
        return $this->personal->where('user_id', auth()->user()->id)->get();
    }

    public function store($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean'
        ]);

        if ($validData) {
             $this->personal->title = $validData['title'];
             $this->personal->description = $validData['description'];
             $this->personal->daily = $validData['daily'];
             $this->personal->push_email = $validData['push_email'];
             $this->personal->user_id = auth()->user()->id;
        }

        if ($request->spec_date) {
             $this->personal->spec_date = $request->spec_date;
        }

        if ($request->spec_time) {
             $this->personal->spec_time = $request->spec_time;
        }

        if ($request->remind_before_option && $request->remind_before_option != 'Remind me before') {
             $this->personal->remind_before_option = $request->remind_before_option;
        }

        if ($request->remind_before_value) {
             $this->personal->remind_before_value = $request->remind_before_value;
        }

        $this->personal->save();
    }

    public function update($request) {
        $validData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'daily' => 'required|boolean',
            'push_email' => 'required|boolean',
            'important' => 'required|boolean',
        ]);
        $item = $this->personal->where('id', $request->itemId)->first();

        $item->title = $validData['title'];
        $item->description = $validData['description'];
        $item->push_email = $validData['push_email'];
        $item->important = $validData['important'];

        if ($validData['daily'] == true || $validData['daily'] == 1) {
            $item->remind_before_option = NULL;
            $item->remind_before_value = NULL;
            $item->spec_date = NULL;
            $item->daily = 1;
            if ($request->spec_time) {
                $item->spec_time = $request->spec_time;
            } else {
                $item->spec_time = NULL;
            }
        } else {
            $item->daily = 0;
            if ($request->remind_before_option && $request->remind_before_value) {
                $item->remind_before_option = $request->remind_before_option;
                $item->remind_before_value = $request->remind_before_value;
            } else {
                $item->remind_before_option = NULL;
                $item->remind_before_value = NULL;
            }
            if ($request->spec_date) {
                $item->spec_date = $request->spec_date;
            } else {
                $item->spec_date = NULL;
            }
        }

        if($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $this->uploadImage($item, $request->file('image'));
        }

        $item->save();
    }

    public function delete($id) {
        $item = $this->personal->find($id);
        if($item->image) {
            $item->image->delete();
        }
        $item->delete();

        return true;
    }

    public function uploadImage($item, $imgObj) {
        if($item->image) {
            Storage::disk('personal')->delete($item->image->filename);
        }

        $img = $imgObj->getRealPath();
        $fileSize = $imgObj->getClientSize();
        $filename = uniqid('', true) . '.' . $imgObj->getClientOriginalExtension();
        $originalFilename = $imgObj->getClientOriginalName();

        $imgObj->move(storage_path('personal'), $filename);
        
        $image = new Image;
        $image->filename = $filename;
        $image->original_filename = $originalFilename;
        $image->filesize = $fileSize;
        $image->width = $imgObj->width();
        $image->height = $imgObj->height();
        $image->save();
        
        return $image;
    }

    public function removeImage(Personal $record, $image_id) {
        $image = $this->image->find($image_id);
        if(!$image) {
            return false;
        } 

        Storage::disk('personal')->delete($image->filename);
        $record->image->delete();
    }

}