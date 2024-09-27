<?php

namespace App\Http\Livewire\Layout;

use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public $customer;
    public function mount($id){
        $this->customer = User::find($id);
        // dd($this->customer);
    }
    public function render()
    {
        return view('livewire.layout.main');
    }
}
