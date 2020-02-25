<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\common\ConstantVariable;

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

        if ($this->user->role_name != ConstantVariable::ADMIN) {
            return redirect('/');
        }

        return view('common/regist');
    }

    public function createUser(Request $request)
    {
        $data = array(
            'name' => $request->input('userName'),
            "password" => $request->input('password'),
            "directory" => '',
            "roles_id" => ConstantVariable::USER,
            'status' => ConstantVariable::STATUS_ACTIVE,
            'created_date' => date('yy-m-d h:i:s', time()),
            'created_by' => 'Admin',
            'updated_date' => date('yy-m-d h:i:s', time()),
            'updated_by' => 'Admin'
        );
        \DB::table('users')->insert($data);
        return redirect('/dashboard');
    }
}
