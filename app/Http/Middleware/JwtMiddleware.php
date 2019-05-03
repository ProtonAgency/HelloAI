<?php
namespace App\Http\Middleware;

use Closure;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $user = auth()->userOrFail();
        }
        catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e)
        {
            return response()->json([
                'success' => false,
                'error' => 'Please login',
            ], 401);
        }

        return $next($request);
    }
}
