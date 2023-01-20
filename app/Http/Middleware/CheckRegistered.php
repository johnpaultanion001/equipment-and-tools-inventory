<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckRegistered
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
        if (auth()->user()->isApproved == 0) {
            return redirect()->route('admin.user.approve');
        }
        return $next($request);
    }
}
