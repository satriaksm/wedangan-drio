<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role 2 (cashier)
        if (Auth::check() && Auth::user()->role == 2) {
            return $next($request);
        }

        // Jika bukan cashier, redirect ke halaman lain
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
