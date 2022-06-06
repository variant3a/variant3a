<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Index extends Component
{

    public string $title = 'Profile';

    public function render()
    {
        return view('livewire.user.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
