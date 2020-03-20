<?php

namespace App\Http\Controllers\User;

use App\Http\common\Service\CookieService as ServiceCookieService;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DomainController extends Controller
{
    private $cookieService;

    public function __construct(ServiceCookieService $cookieService)
    {
        $this->cookieService = $cookieService;
    }

    public function index(Request $request)
        {
            if (!$this->cookieService->isAdmin($request)) {
                return view('user/dashboard/domain/index');
            }
            return redirect()->back();
        }
}
