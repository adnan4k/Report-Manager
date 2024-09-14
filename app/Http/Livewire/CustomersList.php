<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CustomersList extends Component
{
    public $customers;
    public function mount()
    {
         $this->customers = User::with(['businesses', 'reminders'])->get();
    }
    public function render()
    {
        return view('livewire.customers-list');
    }
}
