<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class Authentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() || Auth::attempt()) {
            return $next($request);
        }

        return response()->json('UNAUTHORIZED', Response::HTTP_UNAUTHORIZED);
    }
}
