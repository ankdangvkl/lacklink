<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;

use App\Http\common\CookieService;
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
        return view('admin/user-registration')->with('listUser', $this->listUser);
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
            return redirect('/');
        } catch (Exception $ex) {
            return redirect()->back();
        }
    }

    public function detail(Request $request, $id)
    {
        if (!$this->cookieService->isAdmin($request)) {
            return redirect()->back();
        }
        return view('/admin/user-detail')->with('user', $this->userService->getUserById($id));
    }
}
