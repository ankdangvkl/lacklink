<?php

namespace App\Http\service;

use Illuminate\Http\Request;
use App\Http\common\RoleEnum;

class LoginService
{
    // private $user;

    public function __construct()
    {
    }

    public function getUserByName(Request $request)
    {
        return \DB::table('users')
            ->join('roles', 'users.id', '=', 'roles.id')
            ->where('users.user_name', '=', $request->userName)
            ->first();
    }

    public function validUserPassword(Request $request, $user)
    {
        if ($request->password != $user->password) {
            return false;
        }
        return true;
    }

    public function isAdmin($user)
    {
        return $user->role == RoleEnum::ADMIN ? true : false;
    }
}
