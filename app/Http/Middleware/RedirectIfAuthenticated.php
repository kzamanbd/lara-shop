<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($guard));
            }
        }

        return $next($request);
    }

    /**
     * Get the post-authentication redirect path.
     *
     * @param  string|null  $guard
     * @return string
     */
    protected function redirectTo($guard)
    {
        switch ($guard) {
            case 'web':
                return '/admin/dashboard';
            case 'customer':
                return '/customer/dashboard';
            default:
                return '/home';
        }
    }
}
