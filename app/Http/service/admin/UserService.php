<?php

namespace App\Http\service\admin;

use App\Http\common\CookieService;
use App\Http\common\ImmuableVariable;
use App\Http\repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService extends CookieService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
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

    public function getAll($table)
    {
        return $this->userRepository->getAll($table);
    }

    public function addUser($userInfo)
    {
        $dirPath = public_path(ImmuableVariable::USER_FILE_PATH . $userInfo['username']);
        $this->handlerUserJsonData($dirPath, $userInfo);
        $userData = $this->generateUserData($userInfo, $dirPath);
        Log::info('//   Generate user data: [' . json_encode($userData) . ']');
        $this->userRepository->addUser('users', $userData);
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
        }
        $userInfoJsonFilePath = $dirPath . ImmuableVariable::USER_INFO_JSON_FILE;
        $userStatisticJsonFilePath = $dirPath . ImmuableVariable::USER_STATISTIC_JSON_FILE;
        $userIndexFilePath = $dirPath . ImmuableVariable::USER_INDEX_PHP_FILE;
        $userTrackingFilePath = $dirPath . ImmuableVariable::USER_TRACKING_TXT_FILE;
        $dataJsonFile = json_encode(array("k0"=>"http://fakelink.com"));
        Log::info('//   Create file path: [' . $userInfoJsonFilePath . ']');
        Log::info('//   Data of file: [' . $dataJsonFile . ']');
        \File::put($userInfoJsonFilePath, $dataJsonFile);
        Log::info('//   Create file path: [' . $userStatisticJsonFilePath . ']');
        \File::put($userStatisticJsonFilePath, '{}');
        Log::info('//   Create file path: [' . $userIndexFilePath . ']');
        \File::put($userIndexFilePath, '');
        Log::info('//   Create file path: [' . $userTrackingFilePath . ']');
        \File::put($userTrackingFilePath, '');
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
            'created_by'   => ImmuableVariable::ADMIN_ROLE,
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => ImmuableVariable::ADMIN_ROLE,
        );
    }

    private function generateUserJsonContent()
    {

    }
}
