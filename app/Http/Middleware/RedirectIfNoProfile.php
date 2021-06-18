<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class RedirectIfNoProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->profile) {
            return redirect(RouteServiceProvider::CREATE_PROFILE)->with('info-msg', 'Before accessing the rest of our site, you need to make a profile.');
        }
        
        return $next($request);
    }
}
