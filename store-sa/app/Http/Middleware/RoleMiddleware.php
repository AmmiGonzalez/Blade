<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $option)
    {
        if($option == 1)
        {
            if(Auth::user()->IDRol == 1)
            {
                return redirect()->route("home");
            } else return $next($request);
            
        }
        else if($option == 2)
        {
            if(Auth::user()->IDRol == 1 || Auth::user()->IDRol == 3)
            {
                return redirect()->route("home");
            } else return $next($request);
        }
        else return redirect()->route("home");
    }
}
