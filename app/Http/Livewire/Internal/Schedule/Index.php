<?php

namespace App\Http\Livewire\Internal\Schedule;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public string $title = 'Internal Schedule';
    public string $date;
    public $events;
    public $users, $user;

    protected $listeners = ['getEvents', 'replaceEventKey'];

    public function mount()
    {
        $this->users = User::all();
        $this->user = auth()->user();
        $this->getEvents(Carbon::now(), '');
    }

    public function render()
    {
        return view('livewire.internal.schedule.index')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }

    public function getEvents($date, $keyword = '')
    {
        $min = Carbon::parse($date)->subYear();
        $max = Carbon::parse($date)->addYear();

        $query = Event::where('created_by', auth()->id());
        $events = $query->when($keyword, function ($query, $keyword) {
            $query->orWhere('title', 'LIKE', "%$keyword%");
            $query->orWhere('detail', 'LIKE', "%$keyword%");
            $query->orWhere('url', 'LIKE', "%$keyword%");
            $query->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        })
            ->get()->toArray();

        $results = $this->replaceEventKey($events);

        $this->emit('eventsReceived', $results);
    }

    public function moveEvent($event, $oldEvent)
    {
        $diff = Carbon::parse($oldEvent['start'])->diff(Carbon::parse($event['start']));
        $data = Event::find($event['id']);
        $data->start = Carbon::parse($event['start']);
        if ($diff->invert) {
            $data->end = Carbon::parse($data->end)->subDays($diff->d);
        } else {
            $data->end = Carbon::parse($data->end)->addDays($diff->d);
        }
        $data->save();
    }

    public function replaceEventKey($events)
    {
        $results = [];

        foreach ($events as $event) {
            $results[] = [
                'id' => $event['id'],
                'title' => $event['title'],
                'start' => $event['start'],
                'end' => $event['end'],
                'allDay' => $event['all_day'],
            ];
        }

        return $results;
    }
}
