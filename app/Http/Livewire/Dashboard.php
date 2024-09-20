<?php

namespace App\Http\Livewire;

use App\Models\Business;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalMoney;
    public function mount(){
       
      $this->totalMoney = Business::select('price')->get();
    //   dd($this->totalMoney);
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
