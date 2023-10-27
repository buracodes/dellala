<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use JWTAuth;
use Exception;

class VerifyTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('access_token');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            Auth::setUser($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}