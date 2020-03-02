<?php

namespace App\Http\common;

use Illuminate\Http\Request;

use App\Http\common\EnvVariable;

class CookieService
{
    private $lstVar;
    private $userCookie;

    public function __construct(EnvVariable $envVariable)
    {
        $this->lstVar  = $envVariable->getLstVar();
    }

    public function getCookie(Request $request)
    {
        $this->userCookie = $request->cookie(ImmuableVariable::COOKIE_NAME);
        return $this->userCookie != null ? json_decode($this->userCookie) : $this->userCookie;
    }

    public function setCookie(Request $request, $userInfo)
    {
        if ($this->getCookie($request) == null) {
            \Cookie::queue(\Cookie::make(
                ImmuableVariable::COOKIE_NAME,
                $this->generateUserCookieData($userInfo),
                ImmuableVariable::COOKIE_TIME
            ));
        }
    }

    public function forgetCookie(Request $request)
    {
        if ($this->getCookie($request) != null) {
            \Cookie::queue(\Cookie::forget(ImmuableVariable::COOKIE_NAME));
        }
    }

    public function isAdmin(Request $request)
    {
        $userCookie = $this->getCookie($request);
        return ($userCookie != null && $userCookie->role == ImmuableVariable::ADMIN_ROLE);
    }

    private function generateUserCookieData($user)
    {
        return '{"username":' . '"' . $user->name   . '",'
                . '"role":'   . '"' . $user->role   . '",'
                . '"status":' . '"' . $user->status . '"}';
    }
}
