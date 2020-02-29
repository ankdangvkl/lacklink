<?php

namespace App\Http\Controllers;

use App\Http\common\ConstantVariable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\service\LoginService;
use App\Http\common\CookieService;
use App\Http\common\Message;
use App\Http\service\admin\UserService;

class LoginController extends Controller
{
    private $cookieService;
    private $user;
    private $loginService;
    private $userService;
    private $lstenv;

    public function __construct(
        LoginService $loginService,
        CookieService $cookieService,
        UserService $userService,
        ConstantVariable $constantVariable
    ) {
        $this->loginService = $loginService;
        $this->cookieService = $cookieService;
        $this->userService = $userService;
        $this->lstenv = $constantVariable->getLstConst();
    }

    public function index(Request $request)
    {
        if ($this->cookieService->getCookie($request) == null) {
            return view('common/login');
        } else {
            if ($this->cookieService->isAdmin($request)) {
                return view(
                    'admin/dashboard/index',
                    ['listUser' => $this->userService->getAllUser()]
                );
            }
            return view('user/dashboard/index');
        }
    }

    public function login(Request $request)
    {
        $this->user = $this->loginService->getUserByName($request);
        if ($this->user == null) {
            return view('common/login')->with('error', Message::ERR_LOGIN);
        }
        $this->cookieService->setCookie($request, $this->user);
        if ($this->user->role == $this->lstenv['admin']) {
            return view(
                'admin/dashboard/index',
                ['listUser' => $this->userService->getAllUser()]
            );
        }
        return view('user/dashboard/index');
    }

    public function logout(Request $request)
    {
        if ($this->cookieService->getCookie($request) != null) {
            $this->cookieService->forgetCookie($request);
            return redirect('/');
        }
        return redirect()->back();
    }
}
