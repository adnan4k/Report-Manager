
<?php

use App\Http\Controllers\CustomerRegistration;
use App\Http\Livewire\Multistep;
use Illuminate\Support\Facades\Route;

    Route::get('register', [CustomerRegistration::class, 'register'])
        ->name('register');
        Route::get('multistep',Multistep::class )
        ->name('multistep');

