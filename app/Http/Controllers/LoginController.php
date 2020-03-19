<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\service\LoginService;
use App\Http\common\Message;
use App\Http\service\admin\UserService;
use App\Http\common\Constant\Url;
use App\Http\common\Constant\TablesName;
use App\Http\common\Constant\ViewPath;
use App\Http\common\Constant\Permission;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $loginService;
    private $user;
    private $userService;
    private $lstUser;
    private $listUser = 'listUser';

    public function __construct(
        LoginService $loginService,
        UserService $userService
    ) {
        $this->loginService = $loginService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::INDEX));
        Log::info('//   Request: ' . $request);
        if ($this->loginService->getCookie($request) == null) {
            Log::info('//   Not yet logging! Redirect to login page!');
            return view(ViewPath::LOGIN);
        }
        if (!$this->loginService->isAdmin($request)) {
            Log::info(
              '//   Logged as user: '
              . $this->loginService->getCookie($request)->username
              . '. Redirect to user page!'
            );
            return view(ViewPath::USER_DASHBOARD_INDEX);
          }
          $this->lstUser = $this->userService->getAll(TablesName::USERS);
          Log::info('//   Logged as admin. Redirect to admin page! Gett all user for admin page.');
          Log::info($this->lstUser);
          $lstUserJsonData = $lstUserJsonData = $this->handleUserDataResponse($this->lstUser);
          return view(ViewPath::ADMIN_DASHBOARD_INDEX)
              ->with($this->listUser, $lstUserJsonData);
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
            return view(ViewPath::LOGIN)->with('error', Message::ERR_LOGIN);
        }
        $this->loginService->setCookie($request, $this->user);
        if ($this->user->role == Permission::ADMIN) {
            $this->lstUser = $this->userService->getAll(TablesName::USERS);
            Log::info('//   User logging is admin. Redirect to admin page!');
            Log::info('//   Get all user for admin page!');
            Log::info($this->lstUser);
            $lstUserJsonData = $this->handleUserDataResponse($this->lstUser);
            return view(ViewPath::ADMIN_DASHBOARD_INDEX)
                ->with(
                    $this->listUser,
                    $lstUserJsonData
                );
        }
        return view(ViewPath::USER_DASHBOARD_INDEX);
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
        return redirect(Url::INDEX);
    }

    private function handleUserDataResponse($userList)
    {
      $lstUserJsonData = [];
      foreach ($this->lstUser as $key => $value) {
        $jsonData = $this->userService->getUserJsonData($value->name);
        $lstUserJsonData[$key]['id'] = $value->id;
        $lstUserJsonData[$key]['name'] = $value->name;
        $lstUserJsonData[$key]['directory'] = $value->directory;
        $lstUserJsonData[$key]['role'] = $value->role;
        $lstUserJsonData[$key]['status'] = $value->status;
        $lstUserJsonData[$key]['clicks'] = $jsonData['clicks'];
        $lstUserJsonData[$key]['payAmount'] = $jsonData['payAmount'];
      }
      return $lstUserJsonData;
    }
}
