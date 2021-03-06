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
        $post = Post::find($id);
        $this->post = $post;
        $this->title = $post->title;
    }

    public function render()
    {
        return view('livewire.post.show')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
