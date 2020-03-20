<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('user/dashboard/payment/index');
    }
}
