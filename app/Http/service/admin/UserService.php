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
        $dirPath = resource_path(ImmuableVariable::USER_FILE_PATH . '/' . $userInfo['username']);
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
        $dataJsonFilePath = $dirPath . ImmuableVariable::USER_DATA_JSON_FILE;
        $editPhpFilePath = $dirPath . ImmuableVariable::USER_EDIT_PHP_FILE;
        $indexPhpFilePath = $dirPath . ImmuableVariable::USER_INDEX_PHP_FILE;
        $trackingFilePath = $dirPath . ImmuableVariable::USER_TRACKING_FILE;
        $dataJsonFile = json_encode(array("no.0"=>"http://fakelink.com"));

        Log::info('//   Create file path: [' . $dataJsonFilePath . ']');
        Log::info('//   Data of file: [' . $dataJsonFile . ']');
        \File::put($dataJsonFilePath, $dataJsonFile);
        Log::info('//   Create file path: [' . $editPhpFilePath . ']');
        \File::put($editPhpFilePath, '<?php class edit{}');
        Log::info('//   Create file path: [' . $indexPhpFilePath . ']');
        \File::put($indexPhpFilePath, '<?php lass index{}');
        Log::info('//   Create file path: [' . $trackingFilePath . ']');
        \File::put($trackingFilePath, '');
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
