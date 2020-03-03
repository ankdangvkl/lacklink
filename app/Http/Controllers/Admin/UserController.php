<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;

use App\Http\common\CookieService;
use App\Http\common\ImmuableVariable;
use App\Http\Controllers\Controller;
use App\Http\service\admin\UserService;

class UserController extends Controller
{
    private $listUser;
    private $cookieService;
    private $userService;

    public function __construct(UserService $userService, CookieService $cookieService)
    {
        $this->userService = $userService;
        $this->cookieService = $cookieService;
    }

    public function index(Request $request)
    {
        if (!$this->cookieService->isAdmin($request)) {
            return redirect('/');
        }
        $this->listUser = $this->userService->getAllUser();
        return view(ImmuableVariable::ADMIN_USER_REGIST)->with('listUser', $this->listUser);
    }

    public function createUser(Request $request)
    {
        try {
            if ($this->userService->getUserByName($request->input('userName')) == null) {
                $this->userService->addUser([
                    'username' => $request->input('userName'),
                    'password' => $request->input('password')
                ]);
            }
            return redirect(ImmuableVariable::INDEX_URL)->with('susscess', 'Create user successfully!');
        } catch (Exception $ex) {
            return redirect('/')->with('error', $ex);
        }
    }

    public function detail(Request $request, $id)
    {
        if (!$this->cookieService->isAdmin($request)) {
            return redirect()->back();
        }
        return view(ImmuableVariable::ADMIN_USER_DETAIL)->with('user', $this->userService->getById($id));
    }

    public function updateUserStatus($id)
    {
        $this->userService->updateUserStatus($id);
        return redirect()->back();
    }
}
