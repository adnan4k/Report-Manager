<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;

class ReportList extends Component
{
    public $reports;
    public function mount()
    {
        $this->reports = Report::with('business')->get();
        // dd($this->reports);
    }
    public function render()
    {
        return view('livewire.report-list');
    }
}
