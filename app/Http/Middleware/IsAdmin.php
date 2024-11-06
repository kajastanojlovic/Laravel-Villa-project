<?php

namespace App\Http\Middleware;

use App\Http\Requests\PropertyRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(Auth::user()->role_id);
        if(Auth::check() && Auth::user()->role_id == 2)
        {
            return $next($request);
        }

      return redirect()->back();
    }
}
