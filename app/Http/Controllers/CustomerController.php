<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function get(Request $request) {
        $customers = Customer::get();
        return $customers;
    }
}
