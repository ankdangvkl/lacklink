<?php

namespace App\Http\repositories;

use App\Http\common\ImmuableVariable;

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
            ->where('status', '<>', ImmuableVariable::STATUS_DEACTIVE)
            ->first();
    }
}
