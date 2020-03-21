<?php

namespace App\Http\common\Service;

use Illuminate\Http\Request;

use App\Http\common\Constant\TablesName;
use App\Http\common\Constant\Status;

class CommonService
{

    public function __construct()
    {
    }

    public function getJsonData()
    {
    }

    public function getUserByUserAccount($userAccount)
    {
        return \DB::table(TablesName::USERS)
            ->where('name', '=', $userAccount)
            ->where('status', '<>', Status::DEACTIVE)
            ->first();
    }
}
