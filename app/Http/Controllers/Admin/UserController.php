<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;

use App\Http\common\CookieService;
use App\Http\common\ImmuableVariable;
use App\Http\common\ProjectUrl;
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
        Log::info('//   URL: ' . url(ProjectUrl::CREATE_USER));
        Log::info('//   Request: ' . $request);
        if (!$this->userService->isAdmin($request)) {
            Log::info('//   Normal user trying access to admin page.');
            Log::info('//   Redirect to index.');
            return redirect('/');
        }
        Log::info('//   Redirect to create-user page');
        return view(ImmuableVariable::ADMIN_USER_REGIST);
    }

    public function createUser(Request $request)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(ImmuableVariable::CREATE_USER_URL));
        Log::info('//   Request: ' . $request);
        $userName = $request->input('userName');
        try {
            if ($this->userService->getUserByName($userName) == null) {
                Log::info('//   The user :[' . $userName . '] are not exists.');
                Log::info('//   Create user :[' . $userName . ']');
                DB::beginTransaction();
                $this->userService->addUser([
                    'username' => $request->input('userName'),
                    'password' => $request->input('password')
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Create user success!');
            }
            Log::info('//   The user :[' . $userName . '] are existed.');
            Log::info('//   Rediect back');
            return redirect()->back();
        } catch (Exception $ex) {
            Log::error('//   Create user exsit an exception');
            Log::error('//   Exception: [' . $ex . ']');
            DB::rollback();
            return redirect()->back()->with('error', 'Creating user failed! Please try again!');
        }
    }

    public function detail(Request $request, $id)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(ImmuableVariable::USER_DETAIL_URL));
        Log::info('//   Request: ' . $request);
        if (!$this->userService->isAdmin($request)) {
            Log::info('//   Isn\'t admin user. Redirect!');
            return redirect()->back();
        }
        $userDetail = $this->userService->getById($id);
        Log::info('//   Redirect to detail of user [' . $userDetail->name . ']');
        return view(ImmuableVariable::ADMIN_USER_DETAIL)->with('user', $userDetail);
    }

    public function updateUserStatus(Request $request, $id)
    {
        Log::info('//====================================================================//');
        Log::info('//   URL: ' . url(ImmuableVariable::USER_STATUS_UPDATE_URL));
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
}
