<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Counter extends Component
{
    public $count;

    public function render()
    {
        return view('livewire.counter');
    }

    public function getPostCount()
    {
       $this->count = auth()->user()->posts()->count(); // Select count(*) from posts where user_id = auth id
    }
}
