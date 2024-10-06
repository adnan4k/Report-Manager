<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PaymentComponent extends Component
{
    public $payments;
    public $paid_amount;
    public $status;
    public $month;
    public $payment_date;
    public $selectedPaymentId;
    public $paymentModal = false;

    public function mount()
    {
        $this->payments = Payment::with(['business', 'user'])->get();
        // dd($this->payments);
    }

    public function updatePayment()
    {
        $validatedData = $this->validate([
            'status' => 'required',
            'month' => 'required',
            'payment_date' => 'required',
            'paid_amount' => 'required'
        ]);
        Log::info($validatedData);
        $paymentInformation = Payment::findOrFail($this->selectedPaymentId);
        $paymentInformation->status = $this->status;
        $paymentInformation->month = $this->month;
        $paymentInformation->paid_amount = $this->paid_amount;
        $paymentInformation->save();
        $this->paymentModal = false;
        $this->mount();
        $this->dispatch('payment-updated');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.payment-component');
    }
}
