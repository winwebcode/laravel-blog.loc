<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MyAuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->post('password')); // POST , но может и get

        return redirect()->route('login.form');
    }

    public function loginForm()
    {
        return view('pages.login');
    }
}
