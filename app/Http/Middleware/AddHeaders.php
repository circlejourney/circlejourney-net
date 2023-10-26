<?php namespace Illuminate\Session\Middleware;

use Closure;

// If Laravel >= 5.2 then delete 'use' and 'implements' of deprecated Middleware interface.
class AddHeaders
{
    public function handle($request, $headername, $headervalue, Closure $next)
    {
        $response = $next($request);
        $response->header($headername, $headervalue);

        return $response;
    }
}