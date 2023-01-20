<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Reaction;
use Livewire\Component;

class Show extends Component
{

    public string $title = '';
    public string $share_string = '';
    public bool $like = false;
    public $post;
    public $reactions;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->reactions = $post->reactions()->get();
        $this->like = $post->reactions()->where('json->ip', request()->ip())->get()->isNotEmpty();
        $this->share_string = $post->title . ' - ' . config('app.name', 'Laravel') . "\n" . url()->current();
    }

    public function render()
    {
        return view('livewire.post.show')
            ->extends('layouts.app', ['title' => $this->title, 'tags' => $this->post->tags])
            ->section('content');
    }

    public function like()
    {
        $reaction = Reaction::firstOrNew(['json->ip' => request()->ip()]);
        $reaction->json = [
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ];
        $reaction->post_id = $this->post->id;
        $reaction->save();
        $this->reactions = $this->post->reactions()->get();
        $this->like = true;
    }
}
