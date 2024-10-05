
<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerRegistration;
use App\Http\Livewire\BusinessDetail;
use App\Http\Livewire\CustomerDetail;
use App\Http\Livewire\CustomersList;
use App\Http\Livewire\DetailsPage;
use App\Http\Livewire\DocumentList;
use App\Http\Livewire\EditCustomer;
use App\Http\Livewire\Layout\Main;
use App\Http\Livewire\Multistep;
use App\Http\Livewire\PaymentComponent;
use App\Http\Livewire\ReportDetail;
use App\Http\Livewire\ReportList;
use App\Http\Livewire\Reports\PayrollReports;
use App\Http\Livewire\Reports\StatementReports;
use App\Http\Livewire\Reports\TotReports;
use App\Models\Business;
use Illuminate\Support\Facades\Route;

Route::get('register', action: [CustomerRegistration::class, 'register'])->name('register');
Route::get('register-cusotmer', action: Multistep::class)->name('register-cusotmer');
Route::get('customer-history', action: Multistep::class)->name('customer-history');
Route::get('all-customers', action: CustomersList::class)->name('all-customers');
Route::get('document-list', action: DocumentList::class)->name('document-list');
Route::get(uri: 'statement-reports', action: StatementReports::class)->name('statement-reports');
Route::get(uri: 'tax-reports', action: TotReports::class)->name('tax-reports');
Route::get(uri: 'payroll-reports', action: PayrollReports::class)->name('payroll-reports');
Route::get(uri: 'edit', action: PayrollReports::class)->name('payroll-reports');
Route::get('edit/{id}', EditCustomer::class)->name('edit');
Route::get('details',DetailsPage::class)->name('details');
Route::get('customer-detail/{id}', CustomerDetail::class)->name('customer-detail');
Route::get('main/{id}',Main::class)->name('main');
Route::get('payments',PaymentComponent::class)->name('payments');









