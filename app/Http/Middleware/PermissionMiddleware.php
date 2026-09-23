<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
class PermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Must be logged in
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // ADMIN ROLE → ACCESS EVERYTHING
        if ($user->hasRole('super_admin')) {
            return $next($request);
        }

        // Get route name
        $routeName = $request->route()?->getName();

        // If route has no name, allow it
        if (!$routeName) {
            return $next($request);
        }

        // Permission must exist
        if (!Permission::where('name', $routeName)
            ->where('guard_name', 'web')
            ->exists()) {
            abort(403, "Permission '{$routeName}' does not exist.");
        }

        // Check permission for all non-admin users
        if (!$user->can($routeName)) {
            throw UnauthorizedException::forPermissions([$routeName]);
        }

        return $next($request);
    }
}
