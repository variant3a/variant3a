<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{

    public string $title = '';
    public string $share_string = '';
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->share_string = $post->title . ' - ' . config('app.name', 'Laravel') . "\n" . url()->current();
    }

    public function render()
    {
        return view('livewire.post.show')
            ->extends('layouts.app', ['title' => $this->title, 'tags' => $this->post->tags])
            ->section('content');
    }
}
