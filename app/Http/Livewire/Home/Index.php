<?php

namespace App\Http\Livewire\Home;

use App\Models\Memo;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{

    public string $title = '';
    public string $description = 'Welcome to variant3a\'s Knowledge Base. Will be post technical stories, knowledge and insights.';
    public $posts, $post, $users;
    public $memo;

    protected $rules = [
        'memo.content' => 'nullable|max:10000',
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.home.index')
            ->extends('layouts.app', [
                'title' => $this->title,
                'description' => $this->description,
            ])
            ->section('content');
    }
}
