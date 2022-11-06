<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Str;
use Livewire\Component;

class Toast extends Component
{
    public $toasts;
    public array $show = [];

    protected $listeners = ['bakeToast'];

    public function bakeToast($request)
    {
        $this->toasts[] = [
            'id' => Str::random('5'),
            'status' => $request['status'],
            'message' => $request['message'],
        ];
        $this->show[] = true;
    }
}
