<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use ZipArchive;

class DocumentList extends Component
{
    use WithFileUploads;


    public $businesses;
    public $selectedDocumentType;
    public $selectedBusiness;
    public $file;
    public $open = false;
    protected $rules = [
        'selectedBusiness' => 'required|exists:businesses,id',
        'selectedDocumentType' => 'required',
        'file' => 'required|file|max:2048', // Maximum file size 2MB
    ];

    public function mount()
    {
        $this->businesses = Business::with('documents')
            ->latest()
            ->get();
          $vars =   json_decode($this->businesses->first()->documents->first()->tax, true);
        //   dd($this->businesses);

    }

    public function uploadDocument()
    {
        $this->validate();

        // Fetch the selected business
        $business = Business::with('documents')
        ->where('id',$this->selectedBusiness)
        ->get();
        // Fetch the existing document
        $document = $business->first()->documents->first();

        // Store the file based on document type and append it to the existing files
        switch ($this->selectedDocumentType) {
            case 'payroll':
                $existingPayroll = $document->payroll ? json_decode($document->payroll, true) : [];
                $newPayroll = $this->file->store('payrolls', 'public');
                $existingPayroll[] = $newPayroll;
                $document->payroll = json_encode($existingPayroll);
                break;

            case 'pension':
                $existingPension = $document->pension ? json_decode($document->pension, true) : [];
                $newPension = $this->file->store('pensions', 'public');
                $existingPension[] = $newPension;
                $document->pension = json_encode($existingPension);
                break;

            case 'tax':
                $existingTax = $document->tax ? json_decode($document->tax, true) : [];
                $newTax = $this->file->store('taxs', 'public');
                $existingTax[] = $newTax;
                $document->tax = json_encode($existingTax);
                break;

            case 'income_statement':
                $existingIncomeStatement = $document->income_statement ? json_decode($document->income_statement, true) : [];
                $newIncomeStatement = $this->file->store('income_statements', 'public');
                $existingIncomeStatement[] = $newIncomeStatement;
                $document->income_statement = json_encode($existingIncomeStatement);
                break;

            case 'balance_sheet':
                $existingBalanceSheet = $document->balance_sheet ? json_decode($document->balance_sheet, true) : [];
                $newBalanceSheet = $this->file->store('balance_sheets', 'public');
                $existingBalanceSheet[] = $newBalanceSheet;
                $document->balance_sheet = json_encode($existingBalanceSheet);
                break;
        }

        // Save the updated document
        $document->save();

        // Reset fields after upload
        $this->reset(['file', 'selectedDocumentType']);

        // Emit success message
        $this->dispatch('document-uploaded');
        $this->open = false;

    }

    public function downloadDocuments($businessId)
    {
        $business = Business::with('documents')->findOrFail($businessId);
        $documents = $business->documents;
        // Define the path for the ZIP file
        $zipFileName = 'documents_' . $businessId . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

            foreach ($documents as $document) {

                // Tax document
                $taxPath = storage_path('app/public/' . $document->tax);
                if (file_exists($taxPath)) {
                    $zip->addFile($taxPath, 'Tax_' . basename($taxPath));
                }

                // Income Statement document
                $incomeStatementPath = storage_path('app/public/' . $document->income_statement);
                if (file_exists($incomeStatementPath)) {
                    $zip->addFile($incomeStatementPath, 'Income_Statement_' . basename($incomeStatementPath));
                }

                // Balance Sheet document
                $balanceSheetPath = storage_path('app/public/' . $document->balance_sheet);
                if (file_exists($balanceSheetPath)) {
                    $zip->addFile($balanceSheetPath, 'Balance_Sheet_' . basename($balanceSheetPath));
                }

                // Pension document
                $pensionPath = storage_path('app/public/' . $document->pension);
                if (file_exists($pensionPath)) {
                    $zip->addFile($pensionPath, 'Pension_' . basename($pensionPath));
                }

                // Payroll document
                $payrollPath = storage_path('app/public/' . $document->payroll);
                if (file_exists($payrollPath)) {
                    $zip->addFile($payrollPath, 'Payroll_' . basename($payrollPath));
                }
            }

            $zip->close();
        } else {
            session()->flash('error', 'Unable to create ZIP file');
            return;
        }

        // Trigger download by redirecting to the URL of the ZIP file
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function render()
    {

        return view('livewire.document-list');
    }
}
