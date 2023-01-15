<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Posts';
    public string $keyword = '';
    public $selected_tag = [];
    public $tags;
    protected $posts;

    public function mount()
    {
        $this->posts = Post::paginate(10);
    }

    public function render()
    {
        $this->search();
        return view('livewire.post.index', [
            'posts' => $this->posts,
        ])
            ->extends('layouts.app', ['title' => $this->title, 'tags' => $this->tags])
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

        $this->posts = $posts->paginate(10);

        $tags = Tag::query();

        $tags->whereHas('posts', function ($query) {
            $query->whereExists(function ($query) {
                return $query;
            });
        });
        $tags->withCount('posts');
        $tags->orderBy('posts_count', 'desc');

        $this->tags = $tags->get();

        $this->dispatchBrowserEvent('paginated');
    }
}
