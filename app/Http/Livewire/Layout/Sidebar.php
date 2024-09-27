<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;

class Sidebar extends Component
{
    public $customerId;
    public function mount($customerId){
        $this->customerId = $customerId;
    }
    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
