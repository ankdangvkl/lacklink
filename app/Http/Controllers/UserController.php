<?php

namespace App\Http\Controllers;

use App\Http\common\RoleEnum;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
    }


    public function index(Request $request)
    {
        $this->user = $request->session()->get('userInfo');
        if ($this->user == null) {
            return redirect('/');
        }

        if ($this->user->role_name != RoleEnum::ADMIN) {
            return redirect('/');
        }

        return view('common/regist');
    }

    public function createUser(Request $request)
    {
        $data = array(
            'user_name' => $request->input('userName'),
            "password" => $request->input('password'),
            "roles_id" => 2,
            "data_url" => '',
            'active' => 1,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by' => 'Admin',
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by' => 'Admin'
        );
        \DB::table('users')->insert($data);
        return redirect('/dashboard');
    }
}
