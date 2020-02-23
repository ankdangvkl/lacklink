<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index(Request $request) {
        $userInfo = session('userInfo');
        if ($userInfo == null) {
            return view('common/login');
        }
        return view('dashboard/access');
    }
}
