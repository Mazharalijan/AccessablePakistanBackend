<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('Admin.login');
    }

    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                $admin = Auth::guard('admin')->user();
                if ($admin->role == 2) {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::guard('admin')->logout();

                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel.');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Either Email/password is incorrect');
            }

        } else {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

    }

    public function changePassword(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'current_password' => [
        //         'required',
        //         function ($attribute, $value, $fail) {
        //             if (! \Hash::check($value, Auth::user()->password)) {
        //                 $fail(__('The current password is incorrect.'));
        //             }
        //         },
        //     ],
        //     'password' => 'required|min:6',
        //     'password_confirmation' => 'required|min:6',
        // ]);
        // if ($validator->passes()) {
        //     echo 'passed';
        // } else {
        //     echo 'failed';
        // }
        // $admin = Auth::guard('admin')->user();

        // echo $admin->name;
        return view('Admin.changePassword');

    }
}
