<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $toasts;
    public array $show = [];

    protected $listeners = ['bakeToast'];

    public function bakeToast($request)
    {
        $this->toasts[] = [
            'status' => $request['status'],
            'message' => $request['message'],
        ];
        $this->show[] = true;
    }
}
