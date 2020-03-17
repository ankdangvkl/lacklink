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

    public function getUserByName($table, $username)
    {
        return \DB::table($table)
            ->where('name', '=', $username)
            ->where('status', '<>', Status::DEACTIVE)
            ->first();
    }
}
