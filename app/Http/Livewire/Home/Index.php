<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Index extends Component
{

    public string $title = 'Home';

    public function render()
    {
        return view('livewire.home.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
