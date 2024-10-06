<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\WithFileUploads; // Import the trait


use App\Models\Business;
use App\Models\Document;
use App\Models\Report;
use App\Models\User;
use Livewire\Component;

class Multistep extends Component
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


    public function render()
    {
        return view(view: 'livewire.multistep');
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


    public function submit()
    {
        // Handle Step 1 (User Data)
        // Assuming validation is done and passed
        $this->validation();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->save();


        // Handle Step 2 (Business and Report Data)

        $business = new Business();
        $payment = new Payment();
        $business->user_id = $user->id;
        $business->business_name = $this->business_name;
        $business->tin = $this->tin;
        $business->tax_type = $this->tax_type;
        $payment->initial_price = $this->price;
        $payment->user_id = $user->id;
        $business->save();
        $payment->business_id = $business->id;
        $payment->save();


        $report = new Report();
        $report->business_id = $business->id;
        $report->report_center = $this->report_center;
        $report->tax_due_date = $this->taxtype_due_date;
        $report->payroll_due_date = $this->payroll_due_date;
        $report->statement_due_date = $this->statement_due_date;
        $report->save();

        // Handle Step 3 (Document )
        $document = Document::where('business_id', $business->id)->first() ?? new Document();
        $document->business_id = $business->id;

        // Handle payroll
        $existingPayroll = $document->payroll ? json_decode($document->payroll, true) : [];
        if ($this->payroll) {
            $newPayroll = $this->payroll->store('payrolls', 'public');
            $existingPayroll[] = $newPayroll;
        }
        $document->payroll = json_encode($existingPayroll);

        // Handle pension
        $existingPension = $document->pension ? json_decode($document->pension, true) : [];
        if ($this->pension) {
            $newPension = $this->pension->store('pensions', 'public');
            $existingPension[] = $newPension;
        }
        $document->pension = json_encode($existingPension);

        // Handle tax
        $existingTax = $document->tax ? json_decode($document->tax, true) : [];
        if ($this->tax) {
            $newTax = $this->tax->store('taxs', 'public');
            $existingTax[] = $newTax;
        }
        $document->tax = json_encode($existingTax);

        // Handle income_statement
        $existingIncomeStatement = $document->income_statement ? json_decode($document->income_statement, true) : [];
        if ($this->income_statement) {
            $newIncomeStatement = $this->income_statement->store('income_statements', 'public');
            $existingIncomeStatement[] = $newIncomeStatement;
        }
        $document->income_statement = json_encode($existingIncomeStatement);

        // Handle balance_sheet
        $existingBalanceSheet = $document->balance_sheet ? json_decode($document->balance_sheet, true) : [];
        if ($this->balance_sheet) {
            $newBalanceSheet = $this->balance_sheet->store('balance_sheets', 'public');
            $existingBalanceSheet[] = $newBalanceSheet;
        }
        $document->balance_sheet = json_encode($existingBalanceSheet);

        // Save the document
        $document->save();




        // Redirect or provide feedback
        session()->flash('message', 'Customer Registration Successfully Completed.');
        $this->dispatch('registered');

        return redirect()->to('/all-customers');
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
                'tax_type' => 'required',
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
                'payroll' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif,xls,xlsx,csv',
                'pension' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif,xls,xlsx,csv',
                'tax' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif,xls,xlsx,csv',
                'income_statement' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif,xls,xlsx,csv',
                'balance_sheet' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png,jpg,gif,xls,xlsx,csv',
            ]);
        }

        return $validated;
    }
}
