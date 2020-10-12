<?php

namespace App\Http\Middleware;

use Closure;


class ActiveUserMiddleware
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

        if( Auth()->user()->isNotActive() ){
             Auth()->logout(); // logout user
             return redirect()->route('login')->with('error', ' Account not Activated, Contact Admin ');
        }

        return $next($request);
    }
    
}
