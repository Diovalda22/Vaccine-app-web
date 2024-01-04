<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\societies;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');
        $society = societies::where('login_tokens', $token)->first();

        if($token && $society) {
            return $next($request);
        }else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }
}
