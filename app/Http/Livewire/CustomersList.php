<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CustomersList extends Component
{
    public $customers;
    public $customerToDelete;
    protected $listeners = ['deleteConfirmed' => 'deleteCustomer'];

    public function mount()
    {
        $this->customers = User::with(['businesses', 'reminders'])->get();
    }

    public function deleteConfirmation($id)
    {
        $this->customerToDelete = $id;
        $this->dispatch('showConfirmation', [
            'id' => $this->customerToDelete
        ]);
    }

    public function deleteCustomer($id)
    {
        $customer = User::find($id);

        if ($customer) {
            $customer->delete();
            session()->flash('message', 'Customer deleted successfully!');
        }

        $this->customers = User::with(['businesses', 'reminders'])->get();

        $this->dispatch('customerDeleted');
    }

    public function render()
    {
        return view('livewire.customers-list');
    }
}
