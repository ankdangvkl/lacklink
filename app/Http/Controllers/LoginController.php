<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\service\LoginService;

class LoginController extends Controller
{
    private $user;

    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index(Request $request)
    {
        if ($request->session()->has('userInfo')) {
            return redirect('/dashboard');
        }
        return view('common/login');
    }

    public function login(Request $request)
    {
        $this->user = $this->loginService->getUserByName($request);
        if ($this->user == null) {
            return redirect('/')->with('error', 'User are not exsited! Please try again!');
        }
        if (!$this->loginService->validUserPassword($request, $this->user)) {
            return redirect('/')->with('error', 'Username or password are not currect! Please try again!');
        }
        $request->session()->put('userInfo', $this->user);
        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        if ($request->session()->has('userInfo')) {
            $request->session()->flush();
            return redirect('/');
        }
    }
}
