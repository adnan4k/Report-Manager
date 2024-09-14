
<?php

use App\Http\Controllers\CustomerRegistration;
use App\Http\Livewire\CustomersList;
use App\Http\Livewire\Multistep;
use Illuminate\Support\Facades\Route;

Route::get('register', [CustomerRegistration::class, 'register'])->name('register');
Route::get('register-cusotmer', Multistep::class)->name('register-cusotmer');
Route::get('all-customers', CustomersList::class)->name('all-customers');
Route::get('customer-history', Multistep::class)->name('customer-history');
