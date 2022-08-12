<?php

namespace App\Http\Livewire\Photo;

use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public string $title = 'Photos';
    public $files = [];
    public $photos;

    public function mount()
    {
        $this->getPictures();
    }

    public function render()
    {
        return view('livewire.photo.index', [])
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
