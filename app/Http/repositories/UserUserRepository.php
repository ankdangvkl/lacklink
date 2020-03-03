<?php

namespace App\Http\repositories;

use App\Http\common\EnvVariable;
use App\Http\common\ProjectVariable;
use App\Http\common\Repositories;

class UserUserRepository implements Repositories {

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
        ->where('role', '<>', $this->envVariable['admin'])
        ->get();
    }

    public function getById($table, $id)
    {
        return \DB::table($table)
            ->where('id', $id)
            ->where('role', '<>', $this->projectVariable['admin'])
            ->first();
    }

    public function getUserByName($username)
    {
        // select user by name
        return \DB::table('users')->where('name', '=', $username)->first();
    }
}
