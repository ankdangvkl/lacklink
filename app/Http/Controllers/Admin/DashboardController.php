<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard/index');
    }

    public function access(Request $request)
    {
        return view('common/dashboard/access');
    }

    public function campaign(Request $request)
    {
        return view('common/dashboard/campaign');
    }

    public function domain(Request $request)
    {
        return view('admin/dashboard/domain');
    }

    public function buyPackage(Request $request)
    {
        return view('common/dashboard/package');
    }

    public function instruction(Request $request)
    {
        return view('common/dashboard/instruction');
    }

}
