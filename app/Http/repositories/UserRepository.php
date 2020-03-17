<?php

namespace App\Http\repositories;

use App\Http\common\Constant\Permission;

class UserRepository
{
    public function __construct()
    {
    }

    public function addUser($table, $data)
    {
        return \DB::table($table)->insert($data);
    }

    public function getAll($table)
    {
        return \DB::table($table)
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

    public function getUserByName($table, $username)
    {
        // select user by name
        return \DB::table($table)->where('name', '=', $username)->first();
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
        ->update(array(
            'status' => $user->status
            ,'updated_date' => date('yy-m-d h:i:s', time())
            ,'updated_by' => 'Admin'
        ));
    }
}
