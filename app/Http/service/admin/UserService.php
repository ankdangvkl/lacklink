<?php

namespace App\Http\service\admin;

use App\Http\common\EnvVariable;
use App\Http\common\ImmuableVariable;
use App\Http\repositories\UserRepository;

class UserService
{
    private $envVariable;
    private $userRepository;

    public function __construct(EnvVariable $envVariable, UserRepository $userRepository)
    {
        $this->envVariable = $envVariable->getLstVar();
        $this->userRepository = $userRepository;
    }

    public function getUserByName($username)
    {
        // select user by name
        return \DB::table('users')->where('name', '=', $username)->first();
    }

    public function getById($id)
    {
        // select user by id
        return \DB::table('users')->where('id', '=', $id)->first();
    }

    public function getAllUser()
    {
        return $this->userRepository->getAll();
    }

    public function addUser($userInfo)
    {
        $dirPath = resource_path(ImmuableVariable::USER_FILE_PATH . '/' . $userInfo['username']);
        $this->handlerUserJsonData($dirPath, $userInfo);
        $this->userRepository->addUser($this->generateUserData($userInfo, $dirPath));
    }

    public function updateUserStatus($id)
    {
        return $this->userRepository->updateUserStatus($id);
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
            'Total click' => 10000,
            'trafficSales' => 12345,
            'botTraffic' => 12345678,
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
            "role"         => ImmuableVariable::USER_ROLE,
            'status'       => ImmuableVariable::STATUS_DEACTIVE,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by'   => 'Admin',
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => 'Admin'
        );
    }
}
