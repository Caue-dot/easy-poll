<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showLogin(){
        return view('login');
    }

    public function showRegister(){
        return view('register');
    }
    public function register(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create($data);

        return redirect('/login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'Invalid Credentials.',
        ])->onlyInput('login');
    }
}
