<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReportDetail extends Component
{
    public $customerId;
    public function mount($customerId){
        $this->customerId = $customerId;
    }
    public function render()
    {
        return view('livewire.report-detail');
    }
}
