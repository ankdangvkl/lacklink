<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;

use App\Http\common\Constant\ViewPath;
use App\Http\common\Constant\Url;
use App\Http\Controllers\Controller;
use App\Http\service\admin\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::CREATE_USER));
        Log::info('//   Request: ' . $request);
        if (!$this->userService->isAdmin($request)) {
            Log::info('//   Normal user trying access to admin page.');
            Log::info('//   Redirect to index.');
            return redirect('/');
        }
        Log::info('//   Redirect to create-user page');
        return view(ViewPath::ADMIN_USER_REGIST);
    }

    public function createUser(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::CREATE_USER));
        Log::info('//   Request: ' . $request);
        $userAccount = $request->userAccount;
        try {
            if ($this->userService->getUserByName($userAccount) == null) {
                Log::info('//   The user :[' . $userAccount . '] are not exists.');
                Log::info('//   Create user :[' . $userAccount . ']');
                DB::beginTransaction();
                $this->userService->addUser([
                    'userName' => $request->userName,
                    'userAccount' => $request->userAccount,
                    'address' => $request->address,
                    'password' => $request->password
                ]);
                DB::commit();
                return redirect('/')->with('success', 'Create user success!');
            }
            // Log::info('//   The user :[' . $name . '] are existed.');
            Log::info('//   Rediect back');
            return redirect('/');
        } catch (Exception $ex) {
            Log::error('//   Create user exsit an exception');
            Log::error('//   Exception: [' . $ex . ']');
            DB::rollback();
            return redirect('/')->with('error', 'Creating user failed! Please try again!');
        }
    }

    public function detail(Request $request, $id)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::DETAIL));
        Log::info('//   Request: ' . $request);
        if (!$this->userService->isAdmin($request)) {
            Log::info('//   Isn\'t admin user. Redirect!');
            return redirect()->back();
        }
        $userDetail = $this->userService->getById($id);
        Log::info('//   Redirect to detail of user [' . $userDetail->name . ']');
        return view(ViewPath::ADMIN_USER_DETAIL)->with('user', $userDetail);
    }

    public function updateUserStatus(Request $request, $id)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(Url::STATUS_UPDATE));
        Log::info('//   Request: ' . $request);
        try {
            DB::beginTransaction();
            $this->userService->updateUserStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Update user status success!');
        } catch (Exception $ex) {
            Log::error('//   Update user status exsit an exception');
            Log::error('//   Exception: [' . $ex . ']');
            DB::rollback();
            return redirect()->back()->with('error', 'Update user status failed! Please try again!');
        }
    }

    public function showAddClick(Request $request, $id)
    {
        if (!$this->userService->isAdmin($request)) {
            return redirect()->back();
        }
        $userInfo = $this->userService->getById($id);
        if ($userInfo == null) {
            return redirect()->back()->with(['msg' => 'Nguoi dung khong ton tai!']);
        }
        return view(ViewPath::ADMIN_ADD_CLICK)->with(['userInfo' => $userInfo]);
    }

    public function addClick(Request $request)
    {
        $clickNum = $request->clickNum;
        $userId = $request->userId;
        $userInfo = $this->userService->getById($userId);
        if ($userInfo == null) {
            return redirect()->back()->with(['' => '']);
        }
        $remainingClick = $this->userService->getUserClicks($userInfo->user_account);
        $remainingClick = $remainingClick->clicks + $clickNum;
        $isAddClickSuccess = $this->userService->putUserClicks($userInfo->user_account, $remainingClick);
        if ($isAddClickSuccess == true) {
            return redirect('/')->with(['msg' => 'Nap click thanh cong!']);
        }
        return redirect('/')->with(['msg' => 'Nap click thaat bai!']);
    }
}
