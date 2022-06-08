<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{

    public string $title = 'Posts';
    public string $keyword = '';
    public $selected_tag = [];
    public $posts, $tags;

    public function mount()
    {
        $this->search();
    }

    public function render()
    {
        return view('livewire.post.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function search()
    {
        $keyword = $this->keyword;
        $selected_tag = $this->selected_tag;
        $posts = Post::query();

        if ($keyword) {
            $posts->orWhere('title', 'LIKE', "%$keyword%");
            $posts->orWhere('content', 'LIKE', "%$keyword%");
            $posts->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        }

        if ($selected_tag) {
            $posts->orWhereHas('tags', function ($query) use ($selected_tag) {
                $query->whereIn('tags.id', $selected_tag);
            });
        }

        $posts->orderBy('created_at', 'desc');

        $this->posts = $posts->get();

        $tags = Tag::query();

        $tags->whereHas('posts', function ($query) {
            $query->whereExists(function ($query) {
                return $query;
            });
        });
        $tags->withCount('posts');
        $tags->orderBy('posts_count', 'desc');

        $this->tags = $tags->get();
    }
}
