<?php

namespace App\Http\Middleware;

use App\Helpers\Helpers;
use Closure;

class PermissionMiddleware
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
        // if user does not has permission redirect to home
        if( !Helpers::check_perm($request) ){
            return  redirect()->route('home')->with('error', 'Request Failed!!');
        }
        
        return $next($request);
    }
}
