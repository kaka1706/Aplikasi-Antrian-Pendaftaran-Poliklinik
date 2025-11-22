<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MockAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->header('X-User-ID');
        $role = $request->header('X-User-Role');

        if (!$userId || !$role) {
            return response()->json([
                'message' => 'Unauthorized (MockAuth): Missing X-User-ID or X-User-Role'
            ], 401);
        }

        // Inject user data (mock)
        $request->merge([
            'auth_user' => [
                'id' => intval($userId),
                'role' => strtolower($role)
            ]
        ]);

        return $next($request);
    }
}
