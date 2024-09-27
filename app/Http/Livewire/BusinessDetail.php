<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class BusinessDetail extends Component
{
    public $customer;
    public $customerId;
    public function mount($customerId){
        $this->customerId = $customerId;
       $this->customer = User::where('id',$this->customerId)->with('businesses')->get();
    }
    public function render()
    {
        return view('livewire.business-detail');
    }
}
