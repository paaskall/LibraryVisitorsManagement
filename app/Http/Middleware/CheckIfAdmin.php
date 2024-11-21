<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna adalah admin
        if (Auth::check() && Auth::user()->role->name !== 'admin') {
            // Jika bukan admin, redirect ke halaman welcome
            return redirect('/welcome'); 
        }

        return $next($request);
    }
}
