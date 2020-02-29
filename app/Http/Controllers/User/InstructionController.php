<?php

namespace App\Http\Controllers;

use App\Http\common\CookieService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class InstructionController extends Controller
{
    private $cookieService;

    public function __construct(CookieService $cookieService)
    {
        $this->cookieService = $cookieService;
    }

    public function index(Request $request)
    {
        if (!$this->cookieService->isAdmin($request)) {
            return view('user/dashboard/instruction/index');
        }
        return redirect()->back();
    }
}
