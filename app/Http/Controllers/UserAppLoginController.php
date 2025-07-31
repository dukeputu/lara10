<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class UserAppLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('userApp.userAppView.userLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('app_users')
            ->where('phone_number', $request->phone_number)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('app_user_id', $user->id);
            Session::put('app_user_name', $user->app_u_name ?? '');
            Session::put('app_user_phone', $user->phone_number ?? '');
            Session::put('app_user_photo', $user->user_pic_img ?? '');
            Session::put('app_user_wallet', $user->user_wallet ?? '');
            Session::put('introducer_id', $user->introducer_id ?? '');
            Session::put('introducer_phone', $user->introducer_phone ?? '');
            return redirect()->route('dashboard.app')->with('success', 'Login successful.');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Session::forget('app_user_id');
        Session::forget('app_user_name');
        Session::forget('app_user_phone');
        Session::forget('app_user_photo');
        Session::forget('app_user_wallet');
        Session::forget('introducer_id');
        Session::forget('introducer_phone');
        return redirect()->route('userLogin.app')->with('error', 'Logged out successfully.');
    }
}
