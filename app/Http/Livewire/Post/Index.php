<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{

    public string $title = 'Posts';
    public string $keyword = '';
    public $posts;

    public function render()
    {
        $this->search();
        return view('livewire.post.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function search()
    {
        $posts = Post::query();
        $keyword = $this->keyword;

        if ($keyword) {
            $posts->orWhere('title', 'LIKE', "%$keyword%");
            $posts->orWhere('content', 'LIKE', "%$keyword%");
            $posts->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        }

        $this->posts = $posts->get();
    }
}
