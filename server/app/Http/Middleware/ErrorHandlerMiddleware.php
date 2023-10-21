<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorHandlerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->exception) {
            $statusCode = $response->exception->getStatusCode() ?? 500;
            $message = $response->exception->getMessage() ?? 'Internal Server Error';

            return response()->json([
                'success' => false,
                'statusCode' => $statusCode,
                'message' => $message,
            ], $statusCode);
        }

        return $response;
    }
}
