<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;


class Dashboard extends Component
{
  public $totalMoney;
  public $totalUsers;
  public $reported;
  public $unreported;
  public $tobeReported;
  public $reports;
  public function mount()
  {

    $this->totalMoney = Business::sum('price');
    $this->totalUsers = User::count();
    $this->todayReport();
    $this->reported = Report::where(function ($query) {
      $query->where('statement_status', 1)
        ->where('tax_status', 1)
        ->where('payroll_status', 1);
    })->count();


    $this->unreported = Report::where(function ($query) {
      $query->where('statement_status', 0)
        ->where('tax_status', 0)
        ->where('payroll_status', 0);
    })->count();

    // dd($this->reported);
  }

  public function render()
  {
    return view('livewire.dashboard');
  }

  public function todayReport()
  {
    $this->reports = Report::select('id', 'payroll_status', 'payroll_due_date', 'business_id')
      ->where('payroll_due_date', Carbon::today()) 
      ->where('payroll_status',0)
      ->with(['business:id,business_name,tin'])  
      ->get();
    
  }
}
