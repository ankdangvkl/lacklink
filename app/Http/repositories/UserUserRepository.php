<?php

namespace App\Http\repositories;

use App\Http\common\ImmuableVariable;
use App\Http\common\Repositories;

class UserUserRepository implements Repositories
{
    public function __construct()
    {
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
}
