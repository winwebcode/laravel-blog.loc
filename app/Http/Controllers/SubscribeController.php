<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email|unique:subscriptions',
        ]);

        $subscriber = Subscriber::add($request->get('email'));
        $subscriber->generateToken();
        Mail::to($subscriber)->send(new SubscribeEmail($subscriber));

        return redirect()->back()->with('status', 'Перейдите по ссылке из письма для активации!');
    }

    public function verify($token)
    {
        $subscriber = Subscriber::where('token', '=', $token)->firstOrFail();
        $subscriber->token = null;
        $subscriber->save();
        return redirect()->back()->with('status', 'Спасибо что подписались!');
    }
}
