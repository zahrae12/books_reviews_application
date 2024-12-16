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
         // Ensure the logged-in user is an admin
         if (auth()->check() && auth()->user()->usertype === 1) {
        return $next($request);
         }
         return redirect()->route('home')->with('error', 'You do not have admin privileges.');
    }
}
