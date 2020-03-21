<?php

namespace App\Http\common\Repositories;

use App\Http\common\Constant\FilePath;
use App\Http\common\Constant\TablesName;
use App\Http\common\Constant\Status;

class CommonRepository
{

    public function __construct()
    {
    }

    public function getUserByUserAccount($userAccount)
    {
        return \DB::table(TablesName::USERS)
            ->where('name', '=', $userAccount)->where('status', '<>', Status::DEACTIVE)->first();
    }

    public function getJsonData($userAccount)
    {
        $data = [];

        $data['userinfo'] = json_decode(file_get_contents(public_path(
            FilePath::USER_FILE_PATH
                . $userAccount
                . FilePath::USER_INFO_JSON_FILE
        )));
        $data['userFakeLink'] = json_decode(file_get_contents(public_path(
            FilePath::USER_FILE_PATH
                . $userAccount
                . FilePath::USER_FAKE_LINK_JSON_FILE
        )));
        return $data;
    }

    public function getUserListFakeLink($userAccount)
    {
        return json_decode(file_get_contents(public_path(
            FilePath::USER_FILE_PATH
                . $userAccount
                . FilePath::USER_FAKE_LINK_JSON_FILE
        )));
    }
}
