<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
       
        $user = $request->user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 🔹 Check if the current access token has expired
        if ($user->currentAccessToken()?->expires_at?->isPast()) {
            return response()->json(['error' => 'Token expired'], 401);
        }

        // 🔹 Check user role
        if (! in_array($user->role, $roles)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
