<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

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
        // пропуск дальше в админку - если успеш-авторизация и адм в базе да
        if(Auth::check() && Auth::user()->is_admin) 
        {
            return $next($request);
        }

        abort(404);

    }
}
