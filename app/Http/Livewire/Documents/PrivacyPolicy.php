<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public string $title = 'Privacy Policy';

    public function render()
    {
        return view('livewire.documents.privacy-policy')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
