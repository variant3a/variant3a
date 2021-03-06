<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{

    public string $title = 'Edit Posts';
    public string $previous = '';
    public string $new_tag = '';
    public string $filter_tag = '';
    public int $row = 15;
    public bool $sort_tag = false;
    public $selected_tag = [];
    public $post, $tags;

    protected $rules = [
        'post.title' => 'required|max:255',
        'post.content' => 'required|max:10000',
    ];

    public function mount($id)
    {
        $post = Post::find($id);
        $this->previous = url()->previous();
        $this->post = $post;
        foreach ($post->tags as $tag) {
            $this->selected_tag[] = $tag->id;
        }
        $this->calcRow();
    }

    public function render()
    {
        $this->getTag();
        return view('livewire.post.edit')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updated($property_name)
    {
        $this->calcRow();
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

    public function update()
    {
        $this->validate();

        $data = $this->post;
        $selected_tags = $this->selected_tag;

        DB::transaction(function () use ($data, $selected_tags) {
            $post = Post::find($this->post->id);
            $post->title = $data->title;
            $post->content = $data->content;
            $post->created_by = auth()->id();
            $post->updated_by = auth()->id();
            $post->save();

            $post->tags()->sync($selected_tags);
        });

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

    public function delete()
    {
        $selected_tags = $this->selected_tag;

        DB::transaction(function () use ($selected_tags) {
            $post = Post::find($this->post->id);
            $post->delete();
            $post->tags()->detach($selected_tags);
        });

        return redirect()->route('post.index');
    }

    public function calcRow()
    {
        $content_length = substr_count($this->post['content'] ?? 0, "\n");
        $row = $content_length > 15  ? $content_length + 5 : 15;
        $row = $row > 30  ? 30 : $row;
        $this->row = $row;
    }
}
