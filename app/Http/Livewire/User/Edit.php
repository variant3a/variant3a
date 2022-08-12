<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public string $title = 'Edit Profile';
    public $file;
    public $user;

    protected $rules = [
        'user.user_id' => ['required', 'string', 'max:32'],
        'user.name' => ['required', 'string', 'max:255'],
        'file' => ['nullable', 'image', 'max:4096'],
    ];

    public function mount()
    {
        $this->getUser();
    }

    public function render()
    {
        return view('livewire.user.edit')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function getUser()
    {
        $this->user = auth()->user();
    }

    public function update()
    {
        $this->validate();

        $file = $this->file ?? '';
        $path =  $file ? $file->store('profile-photos') : auth()->user()->profile_photo_path;

        $data = $this->user;

        $user = User::findOrFail(auth()->id());
        $user->name = $data->name;
        $user->profile_photo_path = $path;
        $user->save();

        $this->getUser();
    }
}
