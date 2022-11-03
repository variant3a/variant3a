<?php

namespace App\Http\Livewire\Setting;

use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{

    public string $title = 'Settings';
    public string $new_tag = '';
    public string $filter_tag = '';
    public array $selected_tag = [];
    public array $dev = [];
    public bool $sort_tag = false;
    public $tags;

    protected $rules = [
        'new_tag' => 'required|string|min:1',
        'tags.*.id' => 'required|int',
        'tags.*.name' => 'required|string|min:1',
    ];

    public function mount()
    {
        $this->getTag();
    }

    public function render()
    {
        return view('livewire.setting.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
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
        $this->getTag();
        $this->emitTo('components.toast', 'bakeToast', [
            'status' => 'Success',
            'message' => 'Tag Created successfully.'
        ]);
    }

    public function updateTag()
    {
        // チェックのものだけ抜き出し
        $update_tags = $this->tags
            ->filter(fn ($tag)  => in_array($tag['id'], $this->selected_tag))
            ->map(fn ($tag)  => collect($tag->toArray())->only(['id', 'name', 'created_by', 'updated_by'])->all())
            ->toArray();

        Tag::upsert($update_tags, ['id']);

        $this->new_tag = '';
        $this->selected_tag = [];
        $this->getTag();
        $this->emitTo('components.toast', 'bakeToast', [
            'status' => 'Success',
            'message' => 'Tag has been updated.'
        ]);
    }

    public function deleteTag()
    {
        Tag::destroy($this->selected_tag);
        $this->selected_tag = [];
        $this->getTag();
    }
}
