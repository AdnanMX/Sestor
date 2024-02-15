<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogM;

class LoginC extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            $LogM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Login'
            ]);
            return redirect()->intended('/dashboard');

            // if (Auth::user()->role == 'kasir') {
            //     LogM::create([
            //         'id_user' => Auth::user()->id,
            //         'activity' => 'login'
            //     ]);
            //     return redirect()->intended('/transactions');

            // } else if(Auth::user()->role == 'owner'){
            //     LogM::create([
            //         'id_user' => Auth::user()->id,
            //         'activity' => 'login'
            //     ]);
            //     return redirect()->intended('/dashboard');

            // } else if (Auth::user()->role == 'admin'){
            //     LogM::create([
            //         'id_user' => Auth::user()->id,
            //         'activity' => 'login'
            //     ]);
            //     return redirect()->intended('/dashboard');
            // }
        }

        return back()->withErrors([
            'password' => 'Username Atau Password Salah',
        ]);
    }

     public function logout(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Logout'
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
