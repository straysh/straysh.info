<?php

namespace App\Http\Middleware;

use Closure;
use App\Consts\ErrorCode;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
        {
            if($request->expectsJson())
                return $this->fail('already logon', ErrorCode::ALREADY_LOGIN);
            return redirect('/');
        }

        return $next($request);
    }
}
