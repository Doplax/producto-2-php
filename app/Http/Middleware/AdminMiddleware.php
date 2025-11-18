<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user_email') || 
            $request->session()->get('user_email') !== 'admin@islatransfers.com') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        return $next($request);
    }
}
