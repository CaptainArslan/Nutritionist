<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
    // User RegisterFunction 
    public function userregister(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email|max:150',
            'password' => 'required|min:3|max:12'
        ]);
        $obj = new LoginModel();
        $usercheck = $obj->get_db_data('users', $request->email);
        $count = count($usercheck);
        if ($count > 0) {
            return back()->with('fail', '* Email Already Exist');
        } else {
            $insert = $obj->insert_user($request);

            if ($insert == 0) {
                return redirect('login')->with('Success', '* User Successfullly Registered');
            } else if ($insert == 1) {
                return back()->with('fail', '* Error Occured While Processing');
            } else {
                return back()->with('fail', '* Error Occured While Registeration');
            }
        }
    }


    // User Login Function 
    public function userlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:12'
        ]);
        $obj = new LoginModel();
        $loginuser = $obj->get_db_data('users', '', $request->email);
        if (!$loginuser) {
            return back()->with('fail', 'Email Does not Exist');
        } else {
            $user_id  = $loginuser[0]->id;
            $user_name  = $loginuser[0]->name;
            $user_email = $loginuser[0]->email;
            $user_role = $loginuser[0]->role;
            $user_password = $loginuser[0]->password;
            if (Hash::check($request->password, $user_password)) 
            {
                $request->session()->put('user_id', $user_id);
                $request->session()->put('user_name', $user_name);
                $request->session()->put('user_email', $user_email);
                $request->session()->put('user_role', $user_role);
                return redirect('home');
            } 
            else 
            {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    function logout()
    {
        if (session()->has('user_id')) {
            session()->pull('user_id');
            return redirect('login');
        }
    }

    function dashboard()
    {
        $obj = new LoginModel();
        $admin =count($obj->get_db_data('admins'));
        $nut = count($obj->get_db_data('nutritionist'));
        $cus = count( $obj->get_db_data('customers'));
        $pro =   count($obj->get_db_data('products'));
        $customer = ['customer'=> $obj->get_db_data('customers','','','10') ];
        // dd($customer);
        return view('dashboard',compact( 'admin', 'nut', 'cus', 'pro') , $customer);
    }
}
