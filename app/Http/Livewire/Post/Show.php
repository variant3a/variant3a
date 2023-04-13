<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Reaction;
use Livewire\Component;

class Show extends Component
{

    public string $title = '';
    public string $description = '';
    public string $share_string = '';
    public bool $like = false;
    public $post;
    public $popular_posts;
    public $reactions;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->popular_posts = Post::orderByRaw('json->"$.view" DESC')->limit(5)->get();
        $this->title = $post->title;
        $this->description = $post->json['description'] ?? false;
        $this->reactions = $post->reactions()->get();
        $this->like = $post->reactions()->where('json->ip', request()->ip())->get()->isNotEmpty();
        $this->share_string = $post->title . ' - ' . config('app.name', 'Laravel') . "\n" . url()->current();
        $this->viewCount();
    }

    public function render()
    {
        return view('livewire.post.show')
            ->extends('layouts.app', [
                'title' => $this->title,
                'description' => $this->description,
                'tags' => $this->post->tags,
            ])
            ->section('content');
    }

    public function viewCount()
    {
        $post = $this->post;
        $post->json['view'] = ($post->json['view'] ?: 0) + 1;
        $post->timestamps = false;
        $post->save();
        $post->timestamps = true;
        $this->post = $post;
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
