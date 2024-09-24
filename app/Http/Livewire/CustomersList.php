<?php

namespace App\Http\Livewire;

use App\Exports\CustomersExport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CustomersList extends Component
{
    public $customers;
    public $search = ''; // Add a search property
    public $customerToDelete;
    protected $listeners = ['deleteConfirmed' => 'deleteCustomer'];

    public function mount()
    {
   ;   
        $this->fetchCustomers(); // Call the fetchCustomers method on mount
    }

    // Method to fetch and filter customers based on search term
    public function fetchCustomers()
    {
        $this->customers =   User::with(['businesses', 'reminders'])
            ->where('name', 'like', '%' . $this->search . '%') // Filter by name
            ->orWhere('email', 'like', '%' . $this->search . '%') // Filter by email
            ->orWhereHas('businesses', function ($businessQuery) {
                $businessQuery->where('business_name', 'like', '%' . $this->search . '%')
                    ->orWhere('tin', 'like', '%' . $this->search . '%');
            })->orWhere('phone', 'like', '%' . $this->search . '%') // Filter by email
            ->get();
           

    }
    // Method called when search input is updated
    public function updatedSearch()
    {
        $this->fetchCustomers(); // Update the customer list based on the search term
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

        $this->fetchCustomers(); // Refresh the customer list after deletion

        $this->dispatch('customerDeleted');
    }

    public function exportCustomers()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
    public function exportPDF()
    {
        // Fetch customer data
        $customers = User::with(['businesses'])->get()->map(function ($user) {
            $businessData = $user->businesses->map(function ($business) {
                return [
                    'Business Name' => $business->business_name,
                    'Price' => $business->price,
                    'Payment Status' => $business->payment_status ?? 'Not Paid',
                    'TIN' => $business->tin ?? 'N/A'
                ];
            })->toArray();

            $businessNames = collect($businessData)->pluck('Business Name')->implode(', ');
            $prices = collect($businessData)->pluck('Price')->implode(', ');
            $paymentStatuses = collect($businessData)->pluck('Payment Status')->implode(', ');
            $tins = collect($businessData)->pluck('TIN')->implode(', ');

            return [
                'Customer' => $user->name,
                'Email' => $user->email,
                'Phone' => $user->phone ?? 'N/A',
                'Address' => $user->address ?? 'N/A',
                'Business Name' => $businessNames ?? 'N/A',
                'Price' => $prices ?? 'N/A',
                'Payment Status' => $paymentStatuses ?? 'Not Paid',
                'TIN' => $tins ?? 'N/A'
            ];
        });

        // Load the view and pass the data
        $pdf = Pdf::loadView('exports.customers', compact('customers'));

        // Download the PDF file
        return $pdf->download('customers.pdf');
    }

    public function render()
    {
        return view('livewire.customers-list');
    }
}
