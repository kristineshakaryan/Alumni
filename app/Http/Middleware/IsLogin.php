<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class IsLogin
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
        if (Session::get('userData')) {
            return $next($request);
        }
        return redirect('/login');
    }
}
