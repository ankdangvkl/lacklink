<?php

namespace App\Http\service;

use Illuminate\Http\Request;
use App\Http\common\Service\CookieService;
use App\Http\repositories\LoginRepository;
use Illuminate\Support\Facades\Log;

class LoginService extends CookieService
{
    private $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function getUserStatusByName()
    {
      
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
        if ($requestPassword != $user->password) {
            Log::info('//====================================================================//');
            Log::info('//   Username and password not match together');
            Log::info('//   Input password: [' . $requestPassword . '], password from database: [' . $user->password . ']');
            return false;
        }
        if ($user->status == 0) {
            Log::info('//====================================================================//');
            Log::info('//   User: ['. $user->name . '] are no longger actived! Status are deactived!');
            return false;
        }
        return true;
    }
}
