<?php

namespace App\Http\Livewire\User;

use App\Models\Photo;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public string $title = 'About me';
    public string $hiddenEmail = '';
    public $files = [];
    public $user;
    public $photos;
    public $timelines;

    public function mount()
    {
        $this->getPictures();
        $this->user = User::where('user_id', '=', 'variant3a')->first();
        $this->timelines = Timeline::where('created_by', $this->user->id)->orderBy('start_date', 'asc')->with('tags')->get();
    }

    public function render()
    {
        return view('livewire.user.index')
            ->extends('layouts.app', ['title' => $this->title, 'tags' => $this->timelines->pluck('tags')->collapse()])
            ->section('content');
    }

    public function updatedFiles()
    {
        $this->upload();
    }

    public function getHiddenEmail()
    {
        $this->hiddenEmail = $this->user->email;
    }

    public function getPictures()
    {
        $this->photos = Photo::orderBy('id', 'desc')->get();
    }

    public function deletePicture($id)
    {
        $photo = Photo::find($id);
        DB::transaction(function () use ($photo) {
            Storage::disk('public')->delete($photo->path);
            Storage::disk('public')->delete(
                'webp/' .
                    pathinfo($photo->path, PATHINFO_DIRNAME)  .
                    '/' .
                    pathinfo($photo->path, PATHINFO_FILENAME) .
                    '.webp'
            );
            $photo->delete();
        });
        $this->getPictures();
    }

    public function upload()
    {
        $this->validate([
            'files.*' => 'image|max:256000',
        ]);

        foreach ($this->files as $file) {

            $zipped = Image::make($file);

            DB::transaction(function () use ($file, $zipped) {
                $path = $file->store('photos');

                $zipped
                    ->orientate()
                    ->fit(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->limitColors(null)
                    ->encode('webp')
                    ->save(
                        Storage::disk('public')->path(
                            'webp/' .
                                pathinfo($path, PATHINFO_DIRNAME)  .
                                '/' .
                                pathinfo($path, PATHINFO_FILENAME) .
                                '.webp'
                        )
                    );

                $photo = new Photo;

                $photo->path = $path;
                $photo->comment = '';
                $photo->created_by = auth()->id();
                $photo->updated_by = auth()->id();
                $photo->save();
            });
        }

        $this->getPictures();
    }
}
