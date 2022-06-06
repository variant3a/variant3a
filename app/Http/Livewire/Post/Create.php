<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Mail\Markdown;
use Livewire\Component;

class Create extends Component
{

    public string $title = 'Posts';
    public string $preview = '';
    public $tag = [];
    public $post, $tags;

    protected $rules = [
        'post.title' => 'required|max:255',
        'post.content' => 'required|max:10000',
    ];

    public function render()
    {
        $this->tags = Tag::all();
        $this->preview();
        return view('livewire.post.create')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function preview()
    {
        $content = $this->post['content'] ?? '';
        $this->preview = Markdown::parse(e($content));
    }

    public function store()
    {
        $this->validate();

        $data = $this->post;
        $tags = $this->tag;

        $post = new Post;
        $post->fill($data);
        $post->created_by = auth()->id();
        $post->updated_by = auth()->id();
        $post->save();

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }
}
