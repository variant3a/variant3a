<?php

namespace App\Http\Livewire\Home;

use App\Models\Memo;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{

    public string $title = 'Home';
    public $posts, $post, $users;
    public $memo;

    protected $rules = [
        'memo.content' => 'nullable|max:10000',
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->users = User::all();
        $this->posts = Post::all();
        $this->post = Post::latest()->first();
        $this->memo = Memo::where('created_by', auth()->id())->latest()->first() ?? new Memo();
    }

    public function render()
    {
        return view('livewire.home.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function updated()
    {
        $this->validate();

        $data = $this->memo;

        $memo = Memo::whereDate('created_at', Carbon::today())->firstOrNew();
        $memo->content = $data->content;
        $memo->created_by = auth()->id();
        $memo->updated_by = auth()->id();
        $memo->save();
    }
}
