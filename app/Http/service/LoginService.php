<?php

namespace App\Http\service;

use Illuminate\Http\Request;
use App\Http\common\ConstantVariable;

class LoginService
{
    // private $user;
    private $constantVariable;

    public function __construct(ConstantVariable $constantVariable)
    {
        $this->constantVariable = $constantVariable->getLstConst();
    }

    public function getUserByName(Request $request)
    {
        $user = \DB::table('users')
        ->where('users.name', '=', $request->userName)
        ->where('users.status', '<>', $this->constantVariable['status_deactive'])
        ->first();
        if ($user == null || !$this->validUser($request, $user)) {
            return null;
        }
        return $user;
    }

    private function validUser(Request $request, $user)
    {
        if ($request->password != $user->password) {
            return false;
        }

        if ($user->status == 0) {
            return false;
        }
        return true;
    }
}
