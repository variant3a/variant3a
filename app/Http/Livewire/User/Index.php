<?php

namespace App\Http\Livewire\User;

use App\Models\Photo;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public string $title = 'Profile';
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
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updatedFiles()
    {
        $this->upload();
    }

    public function getPictures()
    {
        $this->photos = Photo::orderBy('id', 'desc')->get();
    }

    public function deletePicture($id)
    {
        $photo = Photo::find($id);
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        $this->getPictures();
    }

    public function upload()
    {
        $this->validate([
            'files.*' => 'image|max:40960',
        ]);

        foreach ($this->files as $file) {
            $path = $file->store('photos');
            $photo = new Photo;

            $photo->path = $path;
            $photo->comment = '';
            $photo->created_by = auth()->id();
            $photo->updated_by = auth()->id();
            $photo->save();
        }

        $this->getPictures();
    }
}
