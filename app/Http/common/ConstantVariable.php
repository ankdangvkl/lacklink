<?php

namespace App\Http\common;

class ConstantVariable {
    private $lstConst;

    public function __construct()
    {
        $this->lstConst = [
            'admin'           => 'ADMIN',
            'user'            => 'USER',
            'status_active'   => 1,
            'status_deactive' => 0,
            'cookie_name'     => env("COOKIE_NAME", 'userAccount'),
            'cookie_time'     => env('COOKIE_TIME', 1440),
            'user_file_path' => env('USER_FILE_PATH', 'data/user')
        ];
    }

    public function getLstConst() {
        return $this->lstConst;
    }
}
