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
    public string $hiddenEmail = '';
    public $files = [];
    public $user;
    public $photos;
    public $timelines;

    public function mount($id)
    {
        $user_id = $id ?? 'variant3a';
        $this->user = User::where('user_id', $user_id)->first();
        $this->getPictures($this->user->id);
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

    public function getHiddenEmail()
    {
        $this->hiddenEmail = $this->user->email;
    }

    public function getPictures($id)
    {
        $this->photos = Photo::where('created_by', $id)->orderBy('id', 'desc')->get();
    }

    public function deletePicture($id)
    {
        $photo = Photo::find($id);
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        $this->getPictures($this->user->id);
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

        $this->getPictures($this->user->id);
    }
}
