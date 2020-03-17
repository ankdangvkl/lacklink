<?php

namespace App\Http\repositories;

use App\Http\common\Constant\Permission;
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
        ->where('role', '<>', Permission::ADMIN)
        ->get();
    }

    public function getById($table, $id)
    {
        return \DB::table($table)
            ->where('id', $id)
            ->where('role', '<>', Permission::ADMIN)
            ->first();
    }

    public function getUserByName($username)
    {
        // select user by name
        return \DB::table('users')->where('name', '=', $username)->first();
    }
}
