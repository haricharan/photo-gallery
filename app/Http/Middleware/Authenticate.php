<?php

namespace PhotoGallery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $role = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            
            return redirect()->guest('login');
        }

        if (!is_null($role) && !$request->user()->hasRole($role)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
