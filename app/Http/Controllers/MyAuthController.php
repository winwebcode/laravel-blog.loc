<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        //валидируем данные, создаём пользователя, редирект на форму логина
        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect()->route('login.form');
    }

    public function loginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        /*попытка авторизации*/
        if(Auth::attempt([
           'email' => $request->get('email'),
           'password' => $request->get('password'),
        ])) {
            return redirect('/');
        }
        else {
            return redirect()->back()->with('status', 'Неправильный логин или пароль');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        /*$request->session()->invalidate();
        $request->session()->regenerateToken();*/

        return redirect('/');
    }
}
