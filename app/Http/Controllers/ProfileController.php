<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'avatar' => 'nullable|image' //не обязательное поле
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('profile')->with('status', 'Данные профиля обновлены');
    }

}
