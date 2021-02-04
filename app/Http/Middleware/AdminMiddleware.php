<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //если юзер залогинен и админ. Auth::user() - вернёт текущий экземпляр модели User если он залогинен
        if(Auth::check() == true && Auth::user()->is_admin == '1') {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
