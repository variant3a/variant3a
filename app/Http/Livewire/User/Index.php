<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public string $title = 'Profile';
    public $user;

    public function mount()
    {
        $this->user = User::where('email', '=', 'sulfur.monoxide168@gmail.com')->first();
    }

    public function render()
    {
        return view('livewire.user.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
