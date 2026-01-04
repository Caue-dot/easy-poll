<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
    public function register(RegisterRequest $request){
        $data = $request->validated();

        User::create($data);

        return redirect('/login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'Credenciais Inválidas',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
