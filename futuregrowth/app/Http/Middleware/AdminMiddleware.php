<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $is2faEnabled = (bool) setting('enable_admin_2fa', false);
            if (!$is2faEnabled || session('admin_2fa_verified') === true) {
                return $next($request);
            }
            return redirect()->route('admin.2fa.show');
        }

        abort(404);
    }
}
