<?php

namespace App\Http\common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\common\Constant\CookieInfo;

class CookieService
{
    private $userCookie;

    public function __construct()
    {
    }

    public function getCookie(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   Get cookie!');
        $this->userCookie = $request->cookie(CookieInfo::NAME);
        return $this->userCookie != null ? json_decode($this->userCookie) : $this->userCookie;
    }

    public function setCookie(Request $request, $userInfo)
    {

        if ($this->getCookie($request) == null) {
            $cookieData = $this->generateUserCookieData($userInfo);
            Log::info('//====================================================================//');
            Log::info('//   Cookie is not exists!');
            Log::info('//   Create cookie!');
            Log::info('//   Cookie name: ' . CookieInfo::NAME);
            Log::info('//   Cookie time: ' . CookieInfo::TIME);
            Log::info('//   Cookie data: ' . $cookieData);
            \Cookie::queue(\Cookie::make(
                CookieInfo::NAME,
                $cookieData,
                CookieInfo::TIME
            ));
        }
    }

    public function forgetCookie(Request $request)
    {
        if ($this->getCookie($request) != null) {
            Log::info('//====================================================================//');
            Log::info('//   Remove cookie: ' . CookieInfo::NAME);
            \Cookie::queue(\Cookie::forget(CookieInfo::NAME));
        }
    }

    public function isAdmin(Request $request)
    {
        $userCookie = $this->getCookie($request);
        return ($userCookie != null && $userCookie->role == CookieInfo::ADMIN_ROLE);
    }

    private function generateUserCookieData($user)
    {
        return '{"username":' . '"' . $user->name   . '",'
                . '"role":'   . '"' . $user->role   . '",'
                . '"status":' . '"' . $user->status . '"}';
    }
}
