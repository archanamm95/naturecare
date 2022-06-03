<?php

namespace App\Http\Middleware;

use App\BlockIP;

use Closure;

class IpMiddleware
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
         $restrictIps = BlockIP::pluck('ip')->toArray();

        if (in_array($request->ip(), $restrictIps)) {
            abort(404);
        }
    
        return $next($request);
    }
}
