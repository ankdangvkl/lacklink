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

    public function getUserByName($userAccount)
    {
        return \DB::table('users')->where('user_account', '=', $userAccount)->first();
    }

    public function getById($id)
    {
        return \DB::table('users')->where('id', '=', $id)->first();
    }

    public function getAll($table)
    {
        return $this->userRepository->getAll($table);
    }

    public function addUser($userInfo)
    {
        if ($this->getUserByName($userInfo['userAccount']) == null) {
            $this->handlerUserJsonData($userInfo);
            $userData = $this->generateUserData($userInfo);
            Log::info('//   Generate user data: [' . json_encode($userData) . ']');
            $this->userRepository->addUser('users', $userData);
        }
    }

    public function updateUserStatus($id)
    {
        return $this->userRepository->updateUserStatus($id);
    }

    public function getUserJsonData($username)
    {
        $userInfo = \file_get_contents(
            public_path(
                FilePath::USER_FILE_PATH
                    . $username
                    . FilePath::USER_INFO_JSON_FILE
            )
        );
        $userInfo = json_decode($userInfo);
        return ['clicks'  => $userInfo->clicks];
    }

    public function getUsersLinks($username)
    {
        $fakeLinks = \file_get_contents(
            public_path(
                FilePath::USER_FILE_PATH
                    . $username
                    . FilePath::USER_FAKE_LINK_JSON_FILE
            )
        );
        $fakeLinks = json_decode($fakeLinks);
        $data = [];
        foreach ($fakeLinks as $key => $link) {
            $data[$key] = $link;
        }
        return $data;
    }

    private function handlerUserJsonData($userInfo)
    {
        $dirPath = public_path(FilePath::USER_FILE_PATH . $userInfo['userAccount']);
        if (!file_exists($dirPath)) {
            \File::makeDirectory($dirPath, 0777, true, true);
            $userInfoFile     = $dirPath . FilePath::USER_INFO_JSON_FILE;
            $userFakeLinkFile = $dirPath . FilePath::USER_FAKE_LINK_JSON_FILE;
            $userTrackingFile = $dirPath . FilePath::USER_TRACKING_TXT_FILE;
            Log::info('//   Create file [' . $userInfoFile . '].');
            \File::put($userInfoFile, '{"clicks" : 0}');
            Log::info('//   Create file [' . $userFakeLinkFile . ']');
            \File::put($userFakeLinkFile, '{}');
            Log::info('//   Create file [ index.php ]');
            \File::copy(
                public_path(FilePath::USER_FILE_PATH . FilePath::TEMPLATE_PATH . FilePath::USER_INDEX_PHP_FILE),
                public_path(FilePath::USER_FILE_PATH . $userInfo['userAccount'] . FilePath::USER_INDEX_PHP_FILE)
            );
            Log::info('//   Create file [' . $userTrackingFile . ']');
            \File::put($userTrackingFile, '');
        }
    }

    private function generateUserData($userInfo)
    {
        return array(
            'user_name'    => $userInfo['userName'],
            'user_account' => $userInfo['userAccount'],
            "password"     => $userInfo['password'],
            "address"      => $userInfo['address'],
            "directory"    => $userInfo['userAccount'] . '/',
            "role"         => Permission::USER,
            'status'       => Status::DEACTIVE,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by'   => Permission::ADMIN,
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => Permission::ADMIN,
        );
    }
}
