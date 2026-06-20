<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return redirect('/pos')->with('error', 'You are not authorized to access admin area');
        }
        
        return $next($request);
    }
}