<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->age == null || Auth::user()->height == null || Auth::user()->weight == null || 
        Auth::user()->race == null || Auth::user()->education == null || Auth::user()->handedness == null) && 
        Auth::user()->is_admin == 0 ) 
        {
            return redirect('/profile/'.Auth::id());
        }
        return $next($request);
    }
}
