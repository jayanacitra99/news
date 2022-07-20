<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth/login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
                            'username'     => 'required',
                            'password'  => 'required',
                        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('admin');
        }
        $request->session()->flash('notif','Login Failed!!');
        return back(); 
    }

    public function logout(){
        Auth::logout();

        Request()->session()->invalidate();

        Request()->session()->regenerateToken();

        Request()->session()->flash('success','Logged Out!!');
        return redirect('/');
    }

    public function changePass(){
        Request()->validate([
            'password'  => 'required|confirmed',
        ]);

        $data = [
            'password' => Hash::make(Request()->password),
        ];

        User::where('username',Auth::user()->username)->update($data);
        Request()->session()->flash('success','Change Password Success!!');
        return redirect('admin');
    }
}
