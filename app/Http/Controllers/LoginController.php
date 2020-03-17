<?php

namespace App\Http\Controllers;

use App\Http\common\ImmuableVariable;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\service\LoginService;
use App\Http\common\Message;
use App\Http\service\admin\UserService;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $loginService;
    private $user;
    private $userService;
    private $lstUser;
    private $userUrl;

    // Temp
    private $listUser = 'listUser';

    public function __construct(
        LoginService $loginService,
        UserService $userService
    ) {
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->userUrl = include 'UserUrl.php';
    }

    public function index(Request $request)
    {
      dd($userUrl);
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(ImmuableVariable::INDEX_URL));
        Log::info('//   Request: ' . $request);
        if ($this->loginService->getCookie($request) == null) {
            Log::info('//   Not yet logging! Redirect to login page!');
            return view(ImmuableVariable::LOGIN);
        } else {
            if ($this->loginService->isAdmin($request)) {
                $this->lstUser = $this->userService->getAll(ImmuableVariable::USERS_TABLE);
                Log::info('//   Logged as admin. Redirect to admin page!');
                Log::info('//   Gett all user for admin page.');
                Log::info($this->lstUser);
                return view(ImmuableVariable::ADMIN_DASHBOARD_INDEX)
                    ->with($this->listUser, $this->lstUser);
            }
            Log::info('//   Logged as user: ' . $this->loginService->getCookie($request)->username . '. Redirect to user page!');
            return view(ImmuableVariable::USER_DASHBOARD_INDEX);
        }
    }

    public function login(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   Logging page!');
        Log::info('//   Request: ' . $request);
        $this->user = $this->loginService->getUserByName($request);
        if ($this->user == null) {
            Log::info('//   Username: [' . $request->input('userName') . '] not found.');
            Log::info('//   Show message: [' . Message::ERR_LOGIN . ']');
            return view(ImmuableVariable::LOGIN)->with('error', Message::ERR_LOGIN);
        }
        $this->loginService->setCookie($request, $this->user);
        if ($this->user->role == ImmuableVariable::ADMIN_ROLE) {
            $this->lstUser = $this->userService->getAll(ImmuableVariable::USERS_TABLE);
            Log::info('//   User logging is admin. Redirect to admin page!');
            Log::info('//   Get all user for admin page!');
            Log::info($this->lstUser);
            return view(ImmuableVariable::ADMIN_DASHBOARD_INDEX)
                ->with(
                    $this->listUser,
                    $this->lstUser
                );
        }
        return view(ImmuableVariable::USER_DASHBOARD_INDEX);
    }

    public function logout(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   Logout.');
        Log::info('//   Request: ' . $request);
        if ($this->loginService->getCookie($request) != null) {
            Log::info('//   Remove cookie.');
            $this->loginService->forgetCookie($request);
        }
        return redirect(ImmuableVariable::INDEX_URL);
    }
}
