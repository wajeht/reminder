<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('sanctum')->check()) {
            auth()->shouldUse('sanctum'); //api sanctum auth

            return $next($request);
        } elseif (auth('web')->check()) {
            auth()->shouldUse('web');       //normal user auth

            return $next($request);
        }

        return response()->json(['message' => 'Unauthenticated!'], Response::HTTP_UNAUTHORIZED);
    }
}
