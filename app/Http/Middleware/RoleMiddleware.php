<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (strtolower(Auth::user()->role->nama_role) !== strtolower($role)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
