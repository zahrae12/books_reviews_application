<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Add this import for Auth
use Symfony\Component\HttpFoundation\Response;
  
class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If the user is an admin (usertype == 1), prevent access to user pages
        if ($user && $user->usertype == 1) {
            return redirect()->route('error')->with('message', 'Admin cannot access user pages.');
        }

        return $next($request);
    }
}
