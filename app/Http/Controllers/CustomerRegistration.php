<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerRegistration extends Controller
{
    //
    public function register()
    {
        return view('customer.register');
    }
}
