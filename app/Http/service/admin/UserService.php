<?php

namespace App\Http\service\admin;

use Exception;
use Illuminate\Support\Facades\Log;

use App\Http\common\Constant\FilePath;
use App\Http\common\Constant\Permission;
use App\Http\common\Constant\Status;
use App\Http\common\Constant\JsonDefault;
use App\Http\common\Constant\TablesName;
use App\Http\common\Constant\OperatorCharacter;
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
      if ($this->getUserByName($userInfo['username']) == null)
      {
        $this->generateUserDataFile($userInfo['username']);
        $userData = $this->generateUserData($userInfo['username'], $userInfo['password']);
        Log::info('//   Generate user: [' . json_encode($userData) . ']');
        $this->userRepository->addUser('users', $userData);
      }
    }

    public function updateUserStatus($id)
    {
        return $this->userRepository->updateUserStatus($id);
    }

    public function getUserRemainingClicks($username)
    {
      $userInfo = file_get_contents(public_path(FilePath::USER_FILE_PATH . $username . FilePath::USER_INFO_JSON_FILE));
      $userInfo = json_decode($userInfo);
      return [
        'clicks' => $userInfo->clicks
        ,'payAmount' => $userInfo->amount
        ];
    }

    private function generateUserDataFile($username)
    {
        $dirPath = public_path(FilePath::USER_FILE_PATH . $username);
        if (!file_exists($dirPath)) {
            \File::makeDirectory($dirPath, 0777, true, true);

            Log::info('//   Create folder user: [' . $username . ']');
            $userInfoFile     = $dirPath . FilePath::USER_INFO_JSON_FILE;
            $userFakeLinkFile = $dirPath . FilePath::USER_FAKE_LINK_JSON_FILE;
            $userTrackingFile = $dirPath . FilePath::USER_TRACKING_TXT_FILE;

            $userInfoFileContent = '{"clicks" : 0,'
                  . '"'. JsonDefault::CLICK_DETAIL .'" : [], "'
                  . JsonDefault::CURRENT_PAY . '" : 0, "payDays" : []}';
            \File::put($userInfoFile, $userInfoFileContent);

            $userFakeLinkFileContent = '{"links": []}';
            \File::put($userFakeLinkFile, $userFakeLinkFileContent);

            \File::copy(
              public_path(FilePath::USER_FILE_PATH . FilePath::TEMPLATE_PATH . 'index.php'),
              public_path(FilePath::USER_FILE_PATH . $username . '/index.php')
            );
            \File::put($userTrackingFile, '');
        }
    }

    private function generateUserData($username, $password)
    {
        return array(
            'name'         => $username,
            "password"     => $password,
            "directory"    => $username,
            "role"         => Permission::USER,
            'status'       => Status::DEACTIVE,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by'   => Permission::ADMIN,
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by'   => Permission::ADMIN,
        );
    }
}
