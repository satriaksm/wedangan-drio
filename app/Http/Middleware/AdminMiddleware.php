<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role 1 (admin)
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman lain
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
