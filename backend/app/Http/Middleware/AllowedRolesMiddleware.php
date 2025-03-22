<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AllowedRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = Auth::user();

        if(!$user) {
            return response()->json([
                'message' => 'no user',
                'data' => $user
            ]);
        }

        if($user && $user->role == 'admin') {
            return $next($request);
        }
        if($user && $user->role == 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

    }
}
 