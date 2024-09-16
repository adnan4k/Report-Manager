<?php

namespace App\Http\Livewire;

use App\Models\Business;
use Livewire\Component;

class DocumentList extends Component
{
    public $businesses;
    public function mount()
    {
        $this->businesses = Business::with('documents')->get();
        // dd($this->businesses);

    }
    public function render()
    {

        return view('livewire.document-list');
    }
}
