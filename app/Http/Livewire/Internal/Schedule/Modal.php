<?php

namespace App\Http\Livewire\Internal\Schedule;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;

class Modal extends Component
{
    public $modal_window;
    public $event;

    protected $listeners = ['dateClick', 'showCreateModal', 'showEditModal', 'closeModal', 'deleteEvent'];

    protected $rules = [
        'event.title' => 'required|string|max:255',
        'event.start' => 'required|date|max:255',
        'event.end' => 'required|date|after_or_equal:event.start|max:255',
        'event.start_time' => 'nullable|string|max:255',
        'event.end_time' => 'nullable|string|max:255',
        'event.url' => 'nullable|url|max:255',
        'event.location' => 'nullable|string|max:255',
        'event.description' => 'nullable|string|max:65535',
        'event.all_day' => 'required|boolean',
    ];

    public function mount()
    {
        $this->users = User::all();
        $this->user = auth()->user();
        $this->modal_window['title'] = 'Create';
        $this->modal_window['show'] = false;
        $this->modal_window['left'] = '0px';
        $this->modal_window['top'] = '0px';
        $this->event['all_day'] = true;
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function showCreateModal($data = ['Create', 0, 0, 0])
    {
        $this->modal_window['show'] = !$this->modal_window['show'];
        $this->modal_window['title'] = $data[0];
        $this->modal_window['left'] = $data[1] . 'px';
        $this->modal_window['top'] = $data[2] . 'px';
        $this->event['start'] = Carbon::parse($data[3])->format('Y-m-d');
        $this->event['end'] = Carbon::parse($data[3])->addDay()->format('Y-m-d');
    }

    public function showEditModal($data = ['Create', 0, 0, null])
    {
        $this->modal_window['show'] = !$this->modal_window['show'];
        $this->modal_window['title'] = $data[0];
        $this->modal_window['left'] = $data[1] . 'px';
        $this->modal_window['top'] = $data[2] . 'px';
        $event = Event::find($data[3]);

        $event['id'] = $event->id;
        $event['title'] = $event->title;
        $event['start'] = Carbon::parse($event->start)->format('Y-m-d');
        $event['end'] = Carbon::parse($event->end)->format('Y-m-d');
        $event['start_time'] = Carbon::parse($event->start)->format('H:i:s');
        $event['end_time'] = Carbon::parse($event->end)->format('H:i:s');
        $event['location'] = $event->location;
        $event['url'] = $event->url;
        $event['description'] = $event->description;
        $event['all_day'] = $this->event['all_day'];
        $this->event = $event;
    }

    public function closeModal()
    {
        $this->reset('event');
        $this->resetValidation();
        $this->event['all_day'] = true;
        $this->modal_window['show'] = !$this->modal_window['show'];
    }

    public function saveEvent()
    {
        $this->validate();
        $event = $this->event;

        if (!isset($event['start_time']) || !isset($event['end_time'])) {
            $start = $event['start'];
            $end = $event['end'];
        } else {
            $start = $event['start'] . ' ' . $event['start_time'];
            $end = $event['end'] . ' ' . $event['end_time'];
        }

        $query = Event::firstOrNew(['id' => $event['id'] ?? null]);
        $query->fill(Arr::except($event, ['start', 'end', 'start_time', 'end_time', 'all_day']));
        $query->start = $start;
        $query->end = $end;
        $query->all_day = $event['all_day'];
        $query->created_by = auth()->id();
        $query->updated_by = auth()->id();
        $query->save();

        $this->emitTo('internal.schedule.index', 'getEvents', $start);
        $this->reset('event');
        $this->closeModal();
    }

    public function deleteEvent()
    {
        $event = $this->event;
        $start = $event['start'];
        Event::find($event['id'])->delete();
        $this->reset('event');
        $this->closeModal();
        $this->emitTo('internal.schedule.index', 'getEvents', $start);
    }
}
