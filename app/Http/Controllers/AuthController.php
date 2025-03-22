<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterReq;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function LoginPage()
    {
        if(Auth::check()){
            return redirect()->intended(route('home'));
        }

        return view('Auth.login');
    }

    public function RegisterPage()
    {
        if(Auth::check()){
            return redirect()->intended(route('home'));
        }
        return view('Auth.register');
    }

    public function doLogin(LoginRequest $request)
    {
        // dd($request->validated());
        $credentials =['name' => $request->name, 'password'=> $request->password];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'You are now connected to your account!');
        }
        return redirect()->back()->withInput()->with('error', 'Invalid credentials');
    }

    public function doLogout()
    {
        session()->put('url.intended', url()->previous());
        Auth::logout();
        return redirect()->intended()->with('success', 'You are now disconnected');
    }

    public function doRegister(RegisterReq $request)
    {
        // dd($request->password);
        if($request->validated()['password'] === $request->validated()['password-confirm']){
            $password = Hash::make($request->password);

            User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => $password,
            ]);
            return redirect()->route('auth.login');
        }
    }
}
