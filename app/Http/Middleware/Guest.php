<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Guest implements AuthenticatesRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user()) {
            return redirect(route('tasks'));
        }

        dd($request->user());
        return $next($request);
    }
}
