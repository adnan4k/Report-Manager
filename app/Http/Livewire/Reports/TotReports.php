<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\Report;
use Livewire\WithPagination;

class TotReports extends Component
{
    use WithPagination;
    public $reports;
    public $statuses = [];  // Use an array to track the status for each report
    public $reportId;

    public function mount()
    {

        $this->reports = Report::select('id', 'tax_status', 'tax_due_date', 'business_id')  // Include 'id'
            ->with(['business:id,business_name'])  // Load only specific fields from the related business
            ->get();

        // Initialize statuses for each report
        foreach ($this->reports as $report) {
            $this->statuses[$report->id] = $report->tax_status;
        }
    }

    public function changeStatus($id)
    {
        // Find the report by id and update the status
        $report = Report::findOrFail($id);
        $status = $this->statuses[$id];  // Use the status from the specific report

        $report->update(['tax_status' => $status]);

        $this->mount();
        // Dispatch the event after status is updated

        $this->dispatch('status-updated', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.reports.tot-reports', [
            'reports' => Report::select('id', 'tax_status', 'tax_due_date', 'business_id')  // Include 'id'
                ->with(['business:id,business_name'])  // Load only specific fields from the related business
                ->paginate(8)
        ]);
    }
}