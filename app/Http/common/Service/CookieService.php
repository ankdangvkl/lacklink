<?php

namespace App\Http\common\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\common\Constant\CookieInfo;
use App\Http\common\Constant\Permission;

class CookieService
{
    private $userCookie;

    public function __construct()
    {
    }

    public function getCookie(Request $request)
    {
        $this->userCookie = $request->cookie(CookieInfo::NAME);
        return $this->userCookie != null ? json_decode($this->userCookie) : null;
    }

    public function setCookie(Request $request, $userInfo)
    {

        if ($this->getCookie($request) == null) {
            $cookieData = $this->generateUserCookieData($userInfo);
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
            Log::info('//   Remove cookie: ' . CookieInfo::NAME);
            \Cookie::queue(\Cookie::forget(CookieInfo::NAME));
        }
    }

    public function isAdmin(Request $request)
    {
        $userCookie = $this->getCookie($request);
        return ($userCookie != null && $userCookie->role == Permission::ADMIN);
    }

    private function generateUserCookieData($user)
    {
        return '{"name":' . '"' . $user->name   . '",'
            . '"role":'   . '"' . $user->role   . '",'
            . '"status":' . '"' . $user->status . '"}';
    }
}
