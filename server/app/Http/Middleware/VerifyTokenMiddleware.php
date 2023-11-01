<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class VerifyTokenMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('access_token'); // Retrieve the token from the access_token cookie

            if (!$token) {
                throw new Exception('Token not provided');
            }

            // Verify the token
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                throw new Exception('User not found');
            }

            // Attach the authenticated user to the request
            $request->merge(['user' => $user]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}