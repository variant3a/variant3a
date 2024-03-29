<?php

namespace App\Http\Livewire\Post;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public string $title = 'Edit Posts';
    public string $previous = '';
    public string $new_tag = '';
    public string $filter_tag = '';
    public int $row = 15;
    public bool $sort_tag = false;
    public $selected_tag = [];
    public $file;
    public $file_path = '';
    public $post_data, $tags;

    protected $rules = [
        'post_data.title' => 'required|max:255',
        'post_data.content' => 'required|max:10000',
        'post_data.json.description' => 'nullable|max:255',
    ];

    public function mount(Post $post)
    {
        $title = 'Create Posts';
        if ($post->exists) {
            $this->post_data = $post->toArray();
            foreach ($post->tags as $tag) {
                $this->selected_tag[] = $tag->id;
            }
            $title = 'Edit Posts';
        }
        $this->title = $title;
        $this->previous = url()->previous();
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
        $this->validateOnly($property_name);
    }

    public function updatedFile()
    {
        $this->upload();
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

        $data = $this->post_data;
        $selected_tags = $this->selected_tag;

        DB::transaction(function () use (&$data, $selected_tags) {
            $post = Post::firstOrNew(['id' => $this->post_data['id'] ?? 'null']);
            $post->fill($data);
            $post->created_by = auth()->id();
            $post->updated_by = auth()->id();
            $post->save();
            $post->tags()->sync($selected_tags);
            $data = $post;
        });

        return redirect()->route('post.detail', $data);
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
            $this->emitTo('components.toast', 'bakeToast', [
                'status' => 'Success',
                'message' => 'Tag Created successfully.'
            ]);
        }

        $this->new_tag = '';

        if (!in_array($tags->id, $this->selected_tag)) {
            $this->selected_tag[] = $tags->id;
        }
    }

    public function upload()
    {
        $this->validate([
            'file' => 'image|max:256000',
        ]);

        $zipped = Image::make($this->file);

        DB::transaction(function () use ($zipped) {
            $path = $this->file->store('posts/pictures');

            $zipped
                ->orientate()
                ->widen(1280)
                ->limitColors(null)
                ->encode('webp')
                ->save(
                    Storage::disk('public')->path(
                        'webp/' .
                            pathinfo($path, PATHINFO_DIRNAME)  .
                            '/' .
                            pathinfo($path, PATHINFO_FILENAME) .
                            '.webp'
                    )
                );

            $photo = new Photo;

            $photo->path = $path;
            $photo->json = ['type' => 'posts'];
            $photo->created_by = auth()->id();
            $photo->updated_by = auth()->id();
            $photo->save();
            $this->file_path = asset('storage/webp/' . pathinfo($photo->path, PATHINFO_DIRNAME) . '/' . pathinfo($photo->path, PATHINFO_FILENAME) . '.webp');
        });
    }

    public function delete()
    {
        $selected_tags = $this->selected_tag;

        DB::transaction(function () use ($selected_tags) {
            $post = Post::find($this->post_data['id']);
            $post->delete();
            $post->tags()->detach($selected_tags);
        });

        return redirect()->route('post.index');
    }
}
