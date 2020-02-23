<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userInfo = session('userInfo');
        if ($userInfo == null) {
            return view('common/login');
        }
        return view('dashboard/index');
    }
    // del session
    // $request->session()->forget('key');

    // $request->session()->flush();
}
