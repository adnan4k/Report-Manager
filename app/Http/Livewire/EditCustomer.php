<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Document;
use App\Models\Report;
use App\Models\User;
use Livewire\Component;

class EditCustomer extends Component
{
    public $currentStep = 1;
    public $totalStep = 3;
    public $name;
    public $email;
    public $phone;
    public $address;
    // Step 2: Business details
    public $business_name;
    public $report_center;
    public $tin;
    public $price;
    public $taxtype_due_date;
    public $payroll_due_date;
    public $statement_due_date;
    // Step 3: Document uploads
    public $payroll_document;
    public $pension_document;
    public $tax_document;
    public $income_statement;
    public $balance_sheet;
    public $payroll;
    public $pension;
    public $tax;
    public $userId;
    public function mount($id){
        $this->edit($id);
    }
    public function render()
    {
        return view('livewire.edit-customer');
    }

    public function edit($id)
    {
        
        $user = User::findOrFail($id);
        $this->userId = $user->id; // Store the user ID
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    //   dd($this->phone);
        // Load Business Data
        $business = Business::where('user_id', $user->id)->firstOrFail();
        $this->business_name = $business->business_name;
        $this->tin = $business->tin;
        $this->price = $business->price;

        // Load Report Data
        $report = Report::where('business_id', $business->id)->firstOrFail();
        $this->report_center = $report->report_center;
        $this->taxtype_due_date = $report->tax_due_date;
        $this->payroll_due_date = $report->payroll_due_date;
        $this->statement_due_date = $report->statement_due_date;

        // Load Document Data
        $document = Document::where('business_id', $business->id)->firstOrFail();
        $this->payroll = $document->payroll;
        $this->pension = $document->pension;
        $this->tax = $document->tax;
        $this->income_statement = $document->income_statement;
        $this->balance_sheet = $document->balance_sheet;

    }
    public function incrementSteps()
    {
        $this->validation();
        if ($this->currentStep < $this->totalStep) {
            $this->currentStep++;
        }
    }
    public function decrementSteps()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }
    public function validation()
    {
        if ($this->currentStep === 1) {
            // Validate Step 1 (Customer Details)
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
            ]);
        } elseif ($this->currentStep === 2) {
            // Validate Step 2 (Business Details)
            $validated = $this->validate([
                'business_name' => 'required|string|max:255',
                'report_center' => 'required|string|max:255',
                'tin' => 'required|string|max:20',
                'price' => 'required|numeric',
                'taxtype_due_date' => 'required|date',
                'payroll_due_date' => 'required|date',
                'statement_due_date' => 'required|date',
            ]);
        } elseif ($this->currentStep === 3) {
            // Validate Step 3 (Document Upload)
            $validated = $this->validate([
                'payroll' => 'required|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif',
                'pension' => 'required|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif',
                'tax' => 'required|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif',
                'income_statement' => 'required|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif',
                'balance_sheet' => 'required|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif',
            ]);
        }

        return $validated;
    }
    public function submit()
    {
        // Handle Step 1 (User Data)
        // Assuming validation is done and passed
        // $this->validation();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->save();


        // Handle Step 2 (Business and Report Data)

        $business = new Business();
        $business->user_id = $user->id;
        $business->business_name = $this->business_name;
        $business->tin = $this->tin;
        $business->price = $this->price;
        $business->save();

        $report = new Report();
        $report->business_id = $business->id;
        $report->report_center = $this->report_center;
        $report->tax_due_date = $this->taxtype_due_date;
        $report->payroll_due_date = $this->payroll_due_date;
        $report->statement_due_date = $this->statement_due_date;
        $report->save();

        // Handle Step 3 (Document Uploads)
        // Assuming validation is done and passed
        $document = new Document();
        $document->business_id = $business->id;
        
        // Check and store each file only if it exists
        if ($this->payroll) {
            $document->payroll = $this->payroll->store('payrolls', 'public');
        }
        
        if ($this->pension) {
            $document->pension = $this->pension->store('pensions', 'public');
        }
        
        if ($this->tax) {
            $document->tax = $this->tax->store('taxs', 'public');
        }
        
        if ($this->income_statement) {
            $document->income_statement = $this->income_statement->store('income_statements', 'public');
        }
        
        if ($this->balance_sheet) {
            $document->balance_sheet = $this->balance_sheet->store('balance_sheets', 'public');
        }
        
        $document->save();
        


        // Redirect or provide feedback
        session()->flash('message', 'Customer Registration Successfully Completed.');
        $this->dispatch('registered');

        return redirect()->to('/all-customers');
    }


}
