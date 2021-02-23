<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function settings()
    {
        $adminDetails = Auth::guard('admin')->user();
        return view('admin.admin_settings', compact('adminDetails'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        return view('admin.admin_login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/dashboard');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        $admin = Auth::guard('admin')->user();
        if (Hash::check($data['current_pwd'], $admin->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCurrentPassword(Request $request)
    {
        $rules = [
            'current_pwd' => 'required',
            'new_pwd' => 'required|confirmed',
        ];
        $customMessages =  [
            'current_pwd.required' => 'Please enter password',
            'new_pwd.required' => 'Please enter new',
            'new_pwd.confirmed' => '"New Password" and "Password Confirmation" must match',
        ];
        $request->validate($rules,  $customMessages);
        $data = $request->all();
        $admin = Auth::guard('admin')->user();
        //Check if pass is correct
        if (Hash::check($data['current_pwd'], $admin->password)) {
            //Find admin and update password with hashed new pass
            Admin::find($admin->id)->update([
                'password' => Hash::make($data['new_pwd']),
            ]);
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'You\'ve Entered an incorrect Current Password');
        }
    }

    public function updateAdminDetails(Request $request)
    {
        $adminDetails = Auth::guard('admin')->user();

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            ];
            $customMessages =  [
                'admin_name.required' => 'Admin name is required',
                'admin_name.regex' => 'Admin Name must contain letters and spaces only',
                'mobile.regex' => 'Invalid Mobile Number',
            ];
            $request->validate($rules,  $customMessages);
            Admin::find($adminDetails->id)->update([
                'name' => $data['admin_name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
            ]);

            return redirect(url('admin/update-admin-details'))->with('success', 'Details Updated Successfully');
        }

        return view('admin.admin_details', compact('adminDetails'));
    }
}
