<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Cors middleware
 * @package App\Http\Middleware
 */
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $next = $next($request);
        $next->headers->set('Access-Control-Allow-Origin', '*');
        $next->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $next->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin, Authorization, Accept, Accept-Language');
        $next->headers->set('Access-Control-Max-Age', '600');

        return $next;
    }
}
