<?php

namespace App\Http\Controllers;

use App\Http\common\EnvVariable;
use App\Http\common\ImmuableVariable;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\service\LoginService;
use App\Http\common\Message;
use App\Http\service\admin\UserService;

class LoginController extends Controller
{
    private $lstVar;
    private $loginService;
    private $user;
    private $userService;

    // Temp
    private const listUser = 'listUser';

    public function __construct(
        LoginService $loginService,
        UserService $userService,
        EnvVariable $envVariable
    ) {
        $this->lstVar = $envVariable->getLstVar();
        $this->loginService = $loginService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($this->loginService->getCookie($request) == null) {
            return view(ImmuableVariable::LOGIN);
        } else {
            if ($this->loginService->isAdmin($request)) {
                return view(ImmuableVariable::ADMIN_DASHBOARD_INDEX)
                    ->with(self::listUser, $this->userService->getAllUser());
            }
            return view(ImmuableVariable::USER_DASHBOARD_INDEX);
        }
    }

    public function login(Request $request)
    {
        $this->user = $this->loginService->getUserByName($request);
        if ($this->user == null) {
            return view(ImmuableVariable::LOGIN)->with('error', Message::ERR_LOGIN);
        }
        $this->loginService->setCookie($request, $this->user);
        if ($this->user->role == ImmuableVariable::ADMIN_ROLE) {
            return view(ImmuableVariable::ADMIN_DASHBOARD_INDEX)
                ->with(self::listUser, $this->userService->getAllUser());
        }
        return view(ImmuableVariable::USER_DASHBOARD_INDEX);
    }

    public function logout(Request $request)
    {
        if ($this->loginService->getCookie($request) != null) {
            $this->loginService->forgetCookie($request);
            return redirect(ImmuableVariable::INDEX_URL);
        }
        return view(ImmuableVariable::LOGIN);
    }
}
