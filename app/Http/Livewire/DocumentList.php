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
        dd($this->businesses);

    }

    public function uploadDocument()
    {
        $this->validate();

        // Fetch the selected business
        $business = Business::find($this->selectedBusiness);

        // Create a new document instance
        $document = new Document();
        $document->business_id = $business->id;

        // Store the file based on document type
        switch ($this->selectedDocumentType) {
            case 'payroll':
                $document->payroll = $this->file->store('payrolls', 'public');
                break;
            case 'pension':
                $document->pension = $this->file->store('pensions', 'public');
                break;
            case 'tax':
                $document->tax = $this->file->store('taxs', 'public');
                break;
            case 'income_statement':
                $document->income_statement = $this->file->store('income_statements', 'public');
                break;
            case 'balance_sheet':
                $document->balance_sheet = $this->file->store('balance_sheets', 'public');
                break;
        }

        $document->save();

        // Reset fields after upload
        $this->reset(['file', 'selectedDocumentType']);
        
        // Emit success message
        $this->dispatch( 'Document uploaded successfully');
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
