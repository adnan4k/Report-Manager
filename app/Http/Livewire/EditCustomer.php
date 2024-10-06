<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Document;
use App\Models\Payment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCustomer extends Component
{
    use WithFileUploads;

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
    public $tax_type;
    public function mount($id)
    {
        $this->edit($id);
    }
    public function render()
    {
        return view('livewire.edit-customer');
    }

    public function edit($id)
    {
        $this->userId  = $id;
        $user = User::findOrFail($id);
        $this->userId = $user->id; // Store the user ID
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        //   dd($this->phone);
        // Load Business Data
        $business = Business::where('user_id', $user->id)->firstOrFail();
        $payment = Payment::where('user_id', $user->id)->firstOrFail();
        $this->business_name = $business->business_name;
        $this->tin = $business->tin;
        $this->price = $payment->initial_price;

        // Load Report Data
        $report = Report::where('business_id', $business->id)->firstOrFail();
        $this->report_center = $report->report_center;
        // Format the dates to 'Y-m-d' for the date input fields
        $this->taxtype_due_date = Carbon::parse($report->tax_due_date)->format('Y-m-d');
        $this->payroll_due_date = Carbon::parse($report->payroll_due_date)->format('Y-m-d');
        $this->statement_due_date =Carbon::parse($report->statement_due_date)->format('Y-m-d');

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
        $validated = '';
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
        }

        return $validated;
    }
    public function submit()
    {
        // Handle Step 1 (User Data)
        $this->validation(); // Validate the form based on the current step
           Log::info($this->tax_type);
        // Find the existing user or create a new one
        $user = User::find($this->userId) ?? new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->save();

        // Handle Step 2 (Business and Report Data)
        $business = Business::where('user_id', $user->id)->first() ?? new Business();
        $payment = Payment::where('user_id', $user->id)->first() ?? new Payment();

        $business->user_id = $user->id;
        $business->business_name = $this->business_name;
        $business->tin = $this->tin;
        $business->tax_type = $this->tax_type;
        $business->save();

        $payment->initial_price = $this->price;
        $payment->user_id = $user->id;
        $payment->business_id = $business->id;
        $payment->save();

        $report = Report::where('business_id', $business->id)->first() ?? new Report();
        $report->business_id = $business->id;
        $report->report_center = $this->report_center;
        $report->tax_due_date = $this->taxtype_due_date;
        $report->payroll_due_date = $this->payroll_due_date;
        $report->statement_due_date = $this->statement_due_date;
        $report->save();

        // Handle Step 3 (Document)
        $document = Document::where('business_id', $business->id)->first() ?? new Document();
        $document->business_id = $business->id;

        // Handle payroll
        $existingPayroll = $document->payroll ? json_decode($document->payroll, true) : [];
        if ($this->payroll && $this->payroll instanceof \Illuminate\Http\UploadedFile) {
            $newPayroll = $this->payroll->store('payrolls', 'public');
            $existingPayroll[] = $newPayroll;
        }
        $document->payroll = json_encode($existingPayroll);

        // Handle pension
        $existingPension = $document->pension ? json_decode($document->pension, true) : [];
        if ($this->pension && $this->pension instanceof \Illuminate\Http\UploadedFile) {
            $newPension = $this->pension->store('pensions', 'public');
            $existingPension[] = $newPension;
        }
        $document->pension = json_encode($existingPension);

        // Handle tax
        $existingTax = $document->tax ? json_decode($document->tax, true) : [];
        if ($this->tax && $this->tax instanceof \Illuminate\Http\UploadedFile) {
            $newTax = $this->tax->store('taxs', 'public');
            $existingTax[] = $newTax;
        }
        $document->tax = json_encode($existingTax);

        // Handle income_statement
        $existingIncomeStatement = $document->income_statement ? json_decode($document->income_statement, true) : [];
        if ($this->income_statement && $this->income_statement instanceof \Illuminate\Http\UploadedFile) {
            $newIncomeStatement = $this->income_statement->store('income_statements', 'public');
            $existingIncomeStatement[] = $newIncomeStatement;
        }
        $document->income_statement = json_encode($existingIncomeStatement);

        // Handle balance_sheet
        $existingBalanceSheet = $document->balance_sheet ? json_decode($document->balance_sheet, true) : [];
        if ($this->balance_sheet && $this->balance_sheet instanceof \Illuminate\Http\UploadedFile) {
            $newBalanceSheet = $this->balance_sheet->store('balance_sheets', 'public');
            $existingBalanceSheet[] = $newBalanceSheet;
        }
        $document->balance_sheet = json_encode($existingBalanceSheet);

        // Save the document
        $document->save();

        // Redirect or provide feedback
        session()->flash('message', 'Customer Registration Successfully Completed.');
        $this->dispatch('customer-updated');

        return redirect()->to('/all-customers');
    }
}
