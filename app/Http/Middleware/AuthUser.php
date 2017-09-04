<?php

namespace App\Http\Middleware;

use Closure;

class AuthUser
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
        if (!session('name'))
        {
            return redirect('loginpage');
        }
        return $next($request);
    }
}
