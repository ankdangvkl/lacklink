<?php

namespace App\Http\common;

use Illuminate\Http\Request;

use App\Http\common\ConstantVariable;

class CookieService
{
    private $userCookie;
    private $lstConst;

    public function __construct(ConstantVariable $constantVariable)
    {
        $this->lstConst  = $constantVariable->getLstConst();
    }

    /**
     *
     * return true if has cookie.
     */
    public function getCookie(Request $request)
    {
        $this->userCookie = $request->cookie($this->lstConst['cookie_name']);
        return $this->userCookie != null ? json_decode($this->userCookie) : $this->userCookie;
    }

    public function setCookie(Request $request, $userInfo)
    {
        if (self::getCookie($request) == null) {
            \Cookie::queue(\Cookie::make(
                $this->lstConst['cookie_name'],
                $this->generateUserCookieData($userInfo),
                $this->lstConst['cookie_time']
            ));
        }
    }

    public function forgetCookie(Request $request)
    {
        if ($this->getCookie($request) != null) {
            \Cookie::queue(\Cookie::forget($this->lstConst['cookie_name']));
        }
    }

    public function isAdmin(Request $request)
    {
        $userCookie = self::getCookie($request);
        return ($userCookie != null && $userCookie->role == $this->lstConst['admin']);
    }

    private function generateUserCookieData($user)
    {
        return '{"username":'   . '"' . $user->name     . '",'
                . '"password":' . '"' . $user->password . '",'
                . '"role":'     . '"' . $user->role     . '",'
                . '"status":'   . '"' . $user->status   . '"}';
    }
}
