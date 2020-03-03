<?php

namespace App\Http\repositories;

use App\Http\common\EnvVariable;
use App\Http\common\ImmuableVariable;
use App\Http\common\ProjectVariable;
use App\Http\common\Repositories;

class UserRepository {

    private $envVariable;

    public function __construct(EnvVariable $envVariable)
    {
        $this->envVariable = $envVariable->getLstVar();
    }

    public function addUser($data)
    {
        \DB::table('users')->insert($data);
    }

    public function getAll()
    {
        return \DB::table('users')
        ->select('id', 'name', 'directory', 'status')
        ->where('role', '<>', ImmuableVariable::ADMIN_ROLE)
        ->get();
    }

    public function getById($table, $id)
    {
        return \DB::table($table)
            ->where('id', $id)
            ->where('role', '<>', ImmuableVariable::ADMIN_ROLE)
            ->first();
    }

    public function getUserByName($username)
    {
        // select user by name
        return \DB::table('users')->where('name', '=', $username)->first();
    }

    public function updateUserStatus($id)
    {
        $user = $this->getById('users', $id);
        if ($user == null) { return; }

        if ($user->status == 0) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        return \DB::table('users')
        ->where('id', $id)
        ->update(array('status' => $user->status));
    }
}
