<?php

namespace App\Http\repositories;

use App\Http\common\Constant\Status;

class LoginRepository
{
    public function __construct()
    {
    }

    public function getById($table, $id)
    {

    }

    public function getUserByUserAccount($table, $username)
    {
        return \DB::table($table)
            ->where('user_account', '=', $username)
            ->where('status', '<>', Status::DEACTIVE)
            ->first();
    }
}
