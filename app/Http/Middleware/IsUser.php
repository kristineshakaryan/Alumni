<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class IsUser
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
        if (Session::get('userData') && Session::get('userData')->type == User::user) {
            return $next($request);
        }

        return redirect('/');
    }
}
