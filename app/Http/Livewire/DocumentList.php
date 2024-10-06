<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Document;
use Illuminate\Support\Facades\Log;
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
    }

    public function uploadDocument()
    {
        $this->validate();

        // Fetch the selected business
        $business = Business::with('documents')
            ->where('id', $this->selectedBusiness)
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
                // Tax document (assuming $document->tax is a JSON-encoded array or single path)
                $this->addFilesToZip($zip, $document->tax, 'Tax_');

                // Income Statement document (assuming JSON array or single path)
                $this->addFilesToZip($zip, $document->income_statement, 'Income_Statement_');

                // Balance Sheet document (assuming JSON array or single path)
                $this->addFilesToZip($zip, $document->balance_sheet, 'Balance_Sheet_');

                // Pension document (assuming JSON array or single path)
                $this->addFilesToZip($zip, $document->pension, 'Pension_');

                // Payroll document (assuming JSON array or single path)
                $this->addFilesToZip($zip, $document->payroll, 'Payroll_');
            }

            $zip->close();
        } else {
            session()->flash('error', 'Unable to create ZIP file');
            return;
        }

        // Trigger download by redirecting to the URL of the ZIP file
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    /**
     * Add files to ZIP.
     *
     * @param ZipArchive $zip
     * @param string $filePath String or JSON array of file paths.
     * @param string $prefix Prefix for the file names in the ZIP.
     */
    private function addFilesToZip($zip, $filePath, $prefix)
    {
        // Check if the file path is a JSON-encoded array or a single file
        if (is_string($filePath) && preg_match('/^\[.*\]$/', $filePath)) {
            $filePaths = json_decode($filePath, true); // Decoding JSON array to PHP array
        } else {
            $filePaths = [$filePath]; // If it's not JSON, treat it as a single path
        }

        // Iterate through each file in the array
        foreach ($filePaths as $path) {
            $fullPath = storage_path('app/public/' . trim($path, '"'));

            Log::info('File Path: ' . $fullPath);

            if (file_exists($fullPath)) {
                $zip->addFile($fullPath, $prefix . basename($fullPath));
            } else {
                Log::info($prefix . ' file does not exist: ' . $fullPath);
            }
        }
    }


    public function render()
    {

        return view('livewire.document-list');
    }
}
