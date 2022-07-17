<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{

    public string $title = 'Edit Profile';
    public $user;

    protected $rules = [
        'user.user_id' => ['required', 'string', 'max:32'],
        'user.name' => ['required', 'string', 'max:255'],
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.user.edit')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function update()
    {
        $this->validate();

        $data = $this->user;

        $user = User::findOrFail(auth()->id());
        $user->name = $data->name;
        $user->save();
    }
}
