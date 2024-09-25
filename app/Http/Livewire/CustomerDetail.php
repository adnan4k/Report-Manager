<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CustomerDetail extends Component
{
    public $customer;
    public $customerId;
    public function mount($id){
        $this->customerId = $id;
        $this->customer = User::find($id);
        session()->flash('customerId', $id);
    }
    public function render()
    {
        return view('livewire.customer-detail');
    }

}
