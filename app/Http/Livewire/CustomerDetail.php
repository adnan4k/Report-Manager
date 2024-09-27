<?php
namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\User;
use Livewire\Component;

class CustomerDetail extends Component
{
    public $customer;
    public $businesses;
    public $id;

    // Ensure mount method accepts the parameter
    public function mount($id)
    {
        // Assign id to the component's public property
        $this->id = $id;

        // Fetch the customer using the provided id
        $this->customer = User::with(['businesses.reports', 'businesses.documents'])->find($id);
        $this->businesses =Business::where('id',$id)
        ->with('documents') 
        ->get();
        // dd($this->businesses);

        // Optionally, store id in session
        session()->flash('id', $id);
    }

    public function render()
    {
        return view('livewire.customer-detail');
    }
}
