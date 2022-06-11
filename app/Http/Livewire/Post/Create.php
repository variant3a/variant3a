<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Mail\Markdown;
use Livewire\Component;

class Create extends Component
{

    public string $title = 'Create Posts';
    public string $previous = '';
    public string $new_tag = '';
    public string $filter_tag = '';
    public bool $sort_tag = false;
    public $selected_tag = [];
    public $post, $tags;

    protected $rules = [
        'post.title' => 'required|max:255',
        'post.content' => 'required|max:10000',
    ];

    public function mount()
    {
        $this->previous = url()->previous();
    }

    public function render()
    {
        $this->getTag();
        return view('livewire.post.create')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
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

    public function store()
    {
        $this->validate();

        $data = $this->post;
        $selected_tags = $this->selected_tag;

        $post = new Post;
        $post->fill($data);
        $post->created_by = auth()->id();
        $post->updated_by = auth()->id();
        $post->save();

        $post->tags()->attach($selected_tags);

        return redirect()->route('post.index');
    }

    public function createTag()
    {
        $validated_data = $this->validate([
            'new_tag' => 'required|string|min:1',
        ]);
        $tags = Tag::firstOrNew(['name' => $validated_data['new_tag']]);

        if (!$tags->exists) {
            $tags->created_by = auth()->id();
            $tags->updated_by = auth()->id();

            $tags->save();
        }

        $this->new_tag = '';

        if (!in_array($tags->id, $this->selected_tag)) {
            $this->selected_tag[] = $tags->id;
        }
    }
}
