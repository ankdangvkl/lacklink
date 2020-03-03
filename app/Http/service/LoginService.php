<?php

namespace App\Http\service;

use App\Http\common\CookieService;
use Illuminate\Http\Request;

use App\Http\common\ProjectVariable;
use App\Http\repositories\LoginRepository;

class LoginService extends CookieService
{
    private $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function getUserByName(Request $request)
    {
        $user = $this->loginRepository->getUserByName('users', $request->input('userName'));
        if ($user == null || !$this->validUser($request->input('password'), $user)) {
            return null;
        }
        return $user;
    }

    private function validUser($requestPassword, $user)
    {
        if ($requestPassword != $user->password) { return false; }
        if ($user->status == 0) { return false; }
        return true;
    }
}
