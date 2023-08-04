<?php

namespace Sunnyr\Company\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request?->user()?->exists() && is_null($request->user()->verified_at)){
            return redirect()->route('fortify.auth.verification');
        }
        return $next($request);
    }
}
