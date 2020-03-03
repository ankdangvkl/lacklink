<?php

namespace App\Http\repositories;

use App\Http\common\EnvVariable;
use App\Http\common\ImmuableVariable;

class LoginRepository
{
    private $envVariable;

    public function __construct(EnvVariable $envVariable)
    {
        $this->envVariable = $envVariable->getLstVar();
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
