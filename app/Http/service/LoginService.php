<?php

namespace App\Http\service;

use Illuminate\Http\Request;
use App\Http\common\ConstantVariable;

class LoginService
{
    // private $user;

    public function __construct()
    {
    }

    public function getUserByName(Request $request)
    {
        return \DB::table('users')
            ->where('users.name', '=', $request->userName)
            ->first();
    }

    public function validUserPassword(Request $request, $user)
    {
        if ($request->password != $user->password) {
            return false;
        }

        if ($user->status == 0) {
            return false;
        }
        return true;
    }

    public function isAdmin($user)
    {
        return $user->role_name == ConstantVariable::ADMIN ? true : false;
    }
}
