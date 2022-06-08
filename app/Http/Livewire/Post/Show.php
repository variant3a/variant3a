<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{

    public string $title = '';
    public $post;

    public function mount($id)
    {
        $this->post = Post::find($id);
    }

    public function render()
    {
        return view('livewire.post.show')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
