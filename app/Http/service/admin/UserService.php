<?php

namespace App\Http\service\admin;

use App\Http\common\ConstantVariable;
use Exception;

class UserService
{
    private $constantVariable;

    public function __construct(ConstantVariable $constantVariable)
    {
        $this->constantVariable = $constantVariable->getLstConst();
    }

    public function getUserByName($username)
    {
        // select user by name
        return \DB::table('users')->where('name', '=', $username)->first();
    }

    public function getUserById($id)
    {
        // select user by id
        return \DB::table('users')->where('id', '=', $id)->first();
    }

    public function getAllUser()
    {
        return \DB::table('users')
            ->select('id', 'name', 'directory', 'status')
            ->where('role', '<>', $this->constantVariable['admin'])
            ->get();
    }

    public function addUser($userInfo)
    {
        $dirPath = resource_path($this->constantVariable['user_file_path'] . $userInfo['username']);
        $this->handlerUserJsonData($dirPath, $userInfo);
        \DB::table('users')->insert($this->generateUserData($userInfo, $dirPath));
    }

    private function handlerUserJsonData($dirPath, $userInfo)
    {
        $filePath = '';
        if (!file_exists($dirPath)) {
            \File::makeDirectory($dirPath, 0777, true, true);
            $filePath = $dirPath . '/' . $userInfo['username'] . '_file.json';
        }
        $data = json_encode([
            'username' => $userInfo['username'],
            'password' => $userInfo['password'],
            'Total click' => 10000,
            'currentTotalClick' => 11000,
            'trafficSales' => 12345,
            'currentTrafficSales' => 123456,
            'botTraffic' => 12345678,
            'currentBotTraffic' => 123456789,
            'currentBlockRate' => 50,
            'blockRate' => 30
        ]);
        \File::put($filePath, $data);
    }

    private function generateUserData($userInfo, $dirPath)
    {
        return array(
            'name'         => $userInfo['username'],
            "password"     => $userInfo['password'],
            "directory"    => $dirPath,
            "role"         => $this->constantVariable['user'],
            'status'       => $this->constantVariable['status_deactive'],
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by'   => 'Admin',
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => 'Admin'
        );
    }
}
