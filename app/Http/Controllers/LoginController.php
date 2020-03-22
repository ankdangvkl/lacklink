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
        $userDataCookie = $this->loginService->getCookie($request);
        if ($userDataCookie == null) {
            Log::info('//   Not yet logging! Redirect to login page!');
            return view(ViewPath::LOGIN);
        }
        if ($userDataCookie->role == Permission::USER) {
            Log::info('//   Logged as user [' . $userDataCookie->name . ']. Redirect to user page!');
            $data = $this->userService->getUserJsonData($userDataCookie->name);
            $fakeLinks = $this->userService->getUsersLinks($userDataCookie->name);
            $data['name'] = $userDataCookie->name;
            $data['fakeLinks'] = $fakeLinks;
            $data['payAmount'] = number_format($data['payAmount']);
            $data['totalPay'] = number_format($data['totalPay']);
            return view(ViewPath::USER_DASHBOARD_INDEX)->with('data', $data);
        }
        $this->lstUser = $this->userService->getAll(TablesName::USERS);
        Log::info('//   Logged as admin. Redirect to admin page! Gett all user for admin page.');
        Log::info($this->lstUser);
        return view(ViewPath::ADMIN_DASHBOARD_INDEX)->with(
            $this->listUser,
            $this->handleUserDataResponse($this->lstUser)
        );
    }

    public function login(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   Logging!');
        Log::info('//   Request: ' . $request);
        $this->user = $this->loginService->getUserByName($request);
        if ($this->user == null) {
            Log::info('//   username [' . $request->input('username') . '] not found.');
            return view(ViewPath::LOGIN)->with('error', Message::ERR_LOGIN);
        }
        $this->loginService->setCookie($request, $this->user);
        if ($this->user->role == Permission::ADMIN) {
            $this->lstUser = $this->userService->getAll(TablesName::USERS);
            Log::info('//   User is admin. Redirect to admin page!');
            Log::info($this->lstUser);
            return view(ViewPath::ADMIN_DASHBOARD_INDEX)->with(
                $this->listUser,
                $this->handleUserDataResponse($this->lstUser)
            );
        }
        $data = $this->userService->getUserJsonData($request->name);
        $fakeLinks = $this->userService->getUsersLinks($request->name);
        $data['name'] = $request->name;
        $data['fakeLinks'] = $fakeLinks;
        $data['payAmount'] = number_format($data['payAmount']);
        $data['totalPay'] = number_format($data['totalPay']);
        return view(ViewPath::USER_DASHBOARD_INDEX)->with('data', $data);
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
            $lstUserJsonData[$key]['username'] = $value->user_name;
            $lstUserJsonData[$key]['name'] = $value->name;
            $lstUserJsonData[$key]['address'] = $value->address;
            $lstUserJsonData[$key]['directory'] = FilePath::USER_FILE_PATH . $value->directory;
            $lstUserJsonData[$key]['status'] = $value->status;
            $lstUserJsonData[$key]['clicks'] = $jsonData['clicks'];
            $lstUserJsonData[$key]['latestPayDay'] = $jsonData['latestPayDay'];
            $lstUserJsonData[$key]['payAmount'] = number_format($jsonData['payAmount']);
            $lstUserJsonData[$key]['totalPay'] = number_format($jsonData['totalPay']);
        }
        return $lstUserJsonData;
    }
}
