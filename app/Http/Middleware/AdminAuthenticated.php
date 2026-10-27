<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    //Check if the logged-in user is an admin
    public function handle(Request $request, Closure $next): Response
    {
        //Deny access if the user is not an admin
        if (!auth()->user()?->isAdmin()) {
            abort(403);
        }

        //Allow the request to continue
        return $next($request);
    }
}
