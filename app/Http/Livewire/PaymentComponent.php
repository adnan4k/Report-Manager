<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class PaymentComponent extends Component
{
    public $payments;
    public $paymentModal = false;
    public function mount(){
        $this->payments = Payment::with(['business','user'])->get();
        // dd($this->payments);
    }
    public function render()
    {
        return view('livewire.payment-component');
    }
}
