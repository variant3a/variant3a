<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Mail\Markdown;
use Livewire\Component;

class Create extends Component
{

    public string $title = 'Create Posts';
    public string $preview = '';
    public string $new_tag = '';
    public string $filter_tag = '';
    public bool $sort_tag = false;
    public $tag = [];
    public $post, $tags;

    protected $rules = [
        'post.title' => 'required|max:255',
        'post.content' => 'required|max:10000',
    ];

    public function render()
    {
        $this->getTag();
        $this->preview();

        return view('livewire.post.create')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getTag()
    {
        $sort = $this->sort_tag ? 'desc' : 'asc';
        $filter = $this->filter_tag;
        $tags = Tag::query();
        if ($filter) {
            $tags->where('name', 'LIKE', "%$filter%");
        }
        $tags->orderBy('name', $sort);
        $this->tags = $tags->get();
    }

    public function sortTag()
    {
        $this->sort_tag = !$this->sort_tag;
        $this->getTag();
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

    public function createTag()
    {
        $selected_tag = Tag::firstOrNew(['name' => $this->new_tag]);
        $selected_tag->created_by = auth()->id();
        $selected_tag->updated_by = auth()->id();
        $selected_tag->save();

        $this->new_tag = '';
        $this->tag[] = $selected_tag->id;
    }
}
