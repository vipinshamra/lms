<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard=null): Response
    {

        switch ($guard) {
            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('dashboard');
              }
              break;
    
            default:
              if (Auth::guard($guard)->check()) {
                return redirect()->route("user.dashboard");
              }
              break;
          }
    
        return $next($request);
    }
}
