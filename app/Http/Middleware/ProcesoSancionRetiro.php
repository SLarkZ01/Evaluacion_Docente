<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProcesoSancionRetiro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $routeMiddleware = [
    // otros middlewares...
    'procesoSancionRetiro' => \App\Http\Middleware\ProcesoSancionRetiro::class,
];

    public function handle(Request $request, Closure $next): Response
    {
        
        return $next($request);
    }

}
