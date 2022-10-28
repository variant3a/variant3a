<?php

namespace App\Http\Livewire\Internal\Dashboard;

use Livewire\Component;

class Index extends Component
{

    public string $title = 'Internal System Dashboard';

    public function render()
    {
        return view('livewire.internal.dashboard.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
