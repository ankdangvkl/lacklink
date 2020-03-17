<?php

namespace App\Http\service\admin;

use Exception;
use Illuminate\Support\Facades\Log;

use App\Http\common\Constant\FilePath;
use App\Http\common\Constant\Permission;
use App\Http\common\Constant\Status;
use App\Http\repositories\UserRepository;
use App\Http\common\Service\CookieService;

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
        $dirPath = public_path(FilePath::USER_FILE_PATH . $userInfo['username']);
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

        $userInfoFile = $dirPath . FilePath::USER_INFO_JSON_FILE;
        $userFakeLinkFile = $dirPath . FilePath::USER_FAKE_LINK_JSON_FILE;
        $userIndexFile = $dirPath . FilePath::USER_INDEX_PHP_FILE;
        $userTrackingFile = $dirPath . FilePath::USER_TRACKING_TXT_FILE;

        $dataJsonFile = json_encode(array("k0"=>"http://fakelink.com"));

        Log::info('//   Create file path: [' . $userInfoFile . ']');
        Log::info('//   Data of file: [' . $dataJsonFile . ']');
        \File::put($userInfoFile, $dataJsonFile);
        Log::info('//   Create file path: [' . $userFakeLinkFile . ']');
        \File::put($userFakeLinkFile, '{}');
        Log::info('//   Create file path: [' . $userIndexFile . ']');
        \File::put($userIndexFile, '');
        Log::info('//   Create file path: [' . $userTrackingFile . ']');
        \File::put($userTrackingFile, '');
    }

    private function generateUserData($userInfo, $dirPath)
    {
        return array(
            'name'         => $userInfo['username'],
            "password"     => $userInfo['password'],
            "directory"    => $dirPath,
            "role"         => Permission::USER,
            'status'       => Status::DEACTIVE,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by'   => Permission::ADMIN,
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => Permission::ADMIN,
        );
    }

    private function generateUserJsonContent()
    {

    }
}
