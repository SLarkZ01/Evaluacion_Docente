<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !$request->user()->id_rol) {
            return redirect('/');
        }

        $userRole = $request->user()->id_rol;
        
        foreach ($roles as $role) {
            // Convert role names to IDs based on your system
            $roleId = match($role) {
                'admin', 'administrador' => 3,
                'docente' => 2,
                'decano' => 1,
                default => null
            };

            if ($userRole === $roleId) {
                return $next($request);
            }
        }

        // Redirect based on user's actual role if they don't have access
        return match($userRole) {
            1 => redirect()->route('user.index'),
            2 => redirect()->route('docente.p_docente'),
            3 => redirect()->route('Admin.Dashboard'),
            default => redirect('/')
        };
    }
}
