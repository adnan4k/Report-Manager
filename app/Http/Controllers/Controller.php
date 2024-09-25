<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function showCustomer($id)
    {
        $customer = User::find($id);

        session()->flash('customerId', $id);

        return view('detial.customer-detail', compact('customer'));
    }

    public function showBusiness($id)
    {
        $customer = User::find($id);

        session()->flash('customerId', $id);

        return view('detial.customer-detail', compact('customer'));
    }

    public function showReport($id)
    {
        $customer = User::find($id);

        session()->flash('customerId', $id);

        return view('detial.customer-detail', compact('customer'));
    }
}
