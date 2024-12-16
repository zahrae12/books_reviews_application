<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Add this import for Auth
use Symfony\Component\HttpFoundation\Response;
  
class CheckUserType
{
   
        public function handle(Request $request, Closure $next): Response
        {
            $user = Auth::user();
    
            // If the user is not an admin
            if ($user && $user->usertype != 1) {
                // Redirect to a specific error page or back to the previous page
                return redirect()->route('error')->with('message', 'Unauthorized Access!');
            }
           
    
            return $next($request);
        }
    
    
}
