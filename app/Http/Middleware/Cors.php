<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        
            if ($request->isMethod('options')) {
                return response('', 200)
                  ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                  ->header('Access-Control-Allow-Headers', 'accept, content-type, 
                    x-xsrf-token, x-csrf-token'); // Add any required headers here
            }
            return $next($request)
        
        ->header("Access-Control-Expose-Headers", "Access-Control-*")
        ->header("Access-Control-Allow-Headers", "Access-Control-*, Origin, X-Requested-With, Content-Type, Accept")
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, HEAD')
        ->header('Access-Control-Allow-Origin', 'localhost:3000')
        ->header('Access-Control-Allow-Credentials', 'true')
        ->header('Allow', 'GET, POST, PUT, DELETE, OPTIONS, HEAD');
        // ->header('Access-Control-Allow-Origin', '*')
        // ->header('Access-Control-Allow-Headers', 'X-PINGOTHER, Content-Type, Authorization, Content-Length, X-Requested-With')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        // ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        // ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization, X-Auth-Token, X-Requested-With');
    }
}
