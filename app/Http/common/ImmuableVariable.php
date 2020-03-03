<?php

namespace App\Http\common;

class ImmuableVariable
{
    const ADMIN_ROLE = 'ADMIN'
          ,USER_ROLE  = 'USER';

    const STATUS_ACTIVE    = 1
          ,STATUS_DEACTIVE = 0;

    const COOKIE_NAME  = 'user-account'
          ,COOKIE_TIME = 1440;

    const USER_FILE_PATH = 'domain/user'
          ,USER_DATA_JSON_FILE = '/data.json'
          ,USER_EDIT_PHP_FILE = '/edit.php'
          ,USER_INDEX_PHP_FILE = '/index.php'
          ,USER_TRACKING_FILE = '/trackingtrackingfile.txt';

    // view file
    const ADMIN_DASHBOARD_INDEX = 'admin/dashboard/index'
          ,LOGIN  = 'common/login'
          ,USER_DASHBOARD_INDEX  = 'user/dashboard/index'
          ,ADMIN_USER_REGIST = 'admin/user-registration'
          ,ADMIN_USER_DETAIL = '/admin/user-detail';

    // URL
    const ACCESS_URL        = '/access'
          ,CREATE_USER_URL  = '/create-user'
          ,DOMAIN_URL       = '/domain'
          ,LOGOUT_URL       = '/logout'
          ,INDEX_URL        = '/'
          ,USER_DETAIL_URL  = '/user-detail/'
          ,USER_STATUS_UPDATE_URL = '/user-status-update/'
          ,PACKAGE_URL      = '/package'
          ,CAMPAIGN_URL     = '/campaign'
          ,INSTRUCTION_URL  = '/instruction';

    // table name
    const USERS_TABLE = 'users';

}
