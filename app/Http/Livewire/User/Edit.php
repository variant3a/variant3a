<?php

namespace App\Http\Livewire\User;

use App\Models\Tag;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public string $title = 'Edit Profile';
    public string $previous = '';
    public string $new_tag = '';
    public string $filter_tag = '';
    public bool $sort_tag = false;
    public $selected_tag = [];
    public $selected_timeline, $file, $user, $timelines, $timeline, $tags;

    protected $rules = [
        'user.user_id' => ['required', 'string', 'max:32'],
        'user.name' => ['required', 'string', 'max:255'],
        'user.state' => ['nullable', 'string', 'max:255'],
        'user.job' => ['nullable', 'string', 'max:255'],
        'user.bio' => ['nullable', 'string', 'max:65535'],
        'user.programming_lang' => ['nullable', 'string', 'max:65535'],
        'user.frameworks' => ['nullable', 'string', 'max:65535'],
        'file' => ['nullable', 'image', 'max:4096'],
        'timeline.icon' => ['nullable', 'string', 'max:64'],
        'timeline.icon_color' => ['nullable', 'string', 'max:32'],
        'timeline.start_date' => ['required', 'string', 'max:32'],
        'timeline.end_date' => ['nullable', 'string', 'max:32'],
        'timeline.title' => ['required', 'string', 'max:255'],
        'timeline.content' => ['nullable', 'string', 'max:65535'],
    ];

    public function mount()
    {
        $this->getTag();
        $this->getUser();
        $this->getTimelines();
    }

    public function render()
    {
        return view('livewire.user.edit')
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

    public function getUser()
    {
        $this->user = User::find(auth()->id());
    }

    public function getTimelines()
    {
        $timelines = Timeline::where('created_by', $this->user->id)->with('tags')->get();
        $this->timelines = $timelines->sortBy('start_date');
        if ($this->selected_timeline) {
            $this->addTimeline($this->selected_timeline);
        } elseif ($timelines) {
            $this->addTimeline($timelines->last()->id);
        } else {
            $this->clearTimeline();
        }
    }

    public function addTimeline($id)
    {
        $timeline = Timeline::find($id);
        $this->timeline = $timeline;
        $this->selected_tag = [];
        $this->selected_timeline = $id;
        foreach ($timeline->tags as $tag) {
            $this->selected_tag[] = $tag->id;
        }
    }

    public function clearTimeline()
    {
        $this->timeline = new Timeline();
        $this->selected_tag = [];
        $this->selected_timeline = 0;
    }

    public function updatedFile()
    {
        $this->uploadProfileImage();
    }

    public function updatedTimeline($property_name)
    {
        $this->validate();

        $data = $this->timeline;
        $selected_tags = $this->selected_tag;

        $timeline = Timeline::findOrNew($this->selected_timeline);
        $timeline->title = $data->title;
        $timeline->content = $data->content;
        $timeline->icon = $data->icon;
        $timeline->icon_color = $data->icon_color;
        $timeline->start_date = $data->start_date;
        $timeline->end_date = $data->end_date;
        $timeline->created_by = auth()->id();
        $timeline->updated_by = auth()->id();
        $timeline->save();

        $this->getTimelines();
    }

    public function updatedSelectedTag($property_name)
    {
        $this->validate();

        $selected_tags = $this->selected_tag;

        $timeline = Timeline::find($this->selected_timeline);
        $timeline->tags()->sync($selected_tags);

        $this->getTimelines();
    }

    public function deleteTimeline()
    {
        Timeline::find($this->selected_timeline)->delete();

        $this->getTimelines();
    }

    public function uploadProfileImage()
    {
        $this->validate([
            'file' => 'image|max:40960',
        ]);

        DB::transaction(function () {
            $user = User::findOrFail(auth()->id());
            if ($user->profile_photo_path) Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = $this->file->store('profile-photos');
            $user->save();
        });

        $this->getUser();
    }

    public function update()
    {
        $this->validate();

        $data = $this->user;

        $user = User::findOrFail(auth()->id());
        $user->fill($data->only(['name', 'state', 'job', 'bio', 'programming_lang', 'frameworks']));
        $user->save();

        $this->getUser();
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

        $this->getTag();
    }
}
