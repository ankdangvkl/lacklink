<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\service\LoginService;
use App\Http\common\Message;
use App\Http\service\admin\UserService;
use App\Http\common\Constant\Url;
use App\Http\common\Constant\TablesName;
use App\Http\common\Constant\FilePath;
use App\Http\common\Constant\ViewPath;
use App\Http\common\Constant\Permission;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $loginService;
    private $user;
    private $userService;
    private $lstUser;
    private $userData = [];
    private $request;
    private $listUser = 'listUser';

    public function __construct(LoginService $loginService, UserService $userService, Request $request)
    {
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->request = $request;
    }

    public function index()
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::INDEX));
        Log::info('//   Request: ' . $this->request);
        $userDataCookie = $this->loginService->getCookie($this->request);
        if ($userDataCookie == null) {
            Log::info('//   Not yet logging! Redirect to login page!');
            return view(ViewPath::LOGIN);
        }
        if ($userDataCookie->role == Permission::USER) {
            Log::info('//   Logged as user [' . $userDataCookie->userAccount . ']. Redirect to user page!');
            $this->userData = $this->userService->getUserJsonData($userDataCookie->userAccount);
            $this->userData['userAccount'] = $userDataCookie->userAccount;
            $this->userData['userName'] = $userDataCookie->userName;
            $this->userData['fakeLinks'] = $this->userService->getUsersLinks($userDataCookie->userAccount);
            return view(ViewPath::USER_DASHBOARD_INDEX)->with('userData', $this->userData);
        }
        $this->lstUser = $this->userService->getAll(TablesName::USERS);
        Log::info('//   Logged as admin. Redirect to admin page! Gett all user for admin page.');
        Log::info($this->lstUser);
        return view(ViewPath::ADMIN_DASHBOARD_INDEX)->with(
            $this->listUser,
            $this->handleUserDataResponse($this->lstUser)
        );
    }

    public function login()
    {
        Log::info('//====================================================================//');
        Log::info('//   Logging!');
        Log::info('//   Request: ' . $this->request);
        $this->userData = $this->loginService->getUserByUserAccount($this->request);
        if ($this->userData == null) {
            Log::info('//   username [' . $this->request->userAccount . '] not found.');
            return view(ViewPath::LOGIN)->with('error', Message::ERR_LOGIN);
        }
        $this->loginService->setCookie($this->request, $this->userData);
        if ($this->userData->role == Permission::ADMIN) {
            $this->lstUser = $this->userService->getAll(TablesName::USERS);
            Log::info('//   User is admin. Redirect to admin page!');
            Log::info($this->lstUser);
            return view(ViewPath::ADMIN_DASHBOARD_INDEX)
                ->with(
                    $this->listUser,
                    $this->handleUserDataResponse()
                );
        }
        $userName = $this->userData->user_name;
        $this->userData = $this->userService->getUserJsonData($this->request->userAccount);
        $this->userData['userAccount'] = $this->request->userAccount;
        $this->userData['userName'] =  $userName;
        $this->userData['fakeLinks'] = $this->userService->getUsersLinks($this->userData['userAccount']);
        return view(ViewPath::USER_DASHBOARD_INDEX)->with('userData', $this->userData);
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

    private function handleUserDataResponse()
    {
        $lstUserJsonData = [];
        foreach ($this->lstUser as $key => $value) {
            $jsonData = $this->userService->getUserJsonData($value->user_account);
            $lstUserJsonData[$key]['id'] = $value->id;
            $lstUserJsonData[$key]['username'] = $value->user_name;
            $lstUserJsonData[$key]['userAccount'] = $value->user_account;
            $lstUserJsonData[$key]['address'] = $value->address;
            $lstUserJsonData[$key]['directory'] = FilePath::USER_FILE_PATH . $value->directory;
            $lstUserJsonData[$key]['status'] = $value->status;
            $lstUserJsonData[$key]['clicks'] = $jsonData['clicks'];
        }
        return $lstUserJsonData;
    }
}
