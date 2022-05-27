<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeIs
{
    use ApiResponses;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $user_type)
    {
        if (Auth::user()->user_type === $user_type)
            return $next($request);
        else
            return $this->Error('Invalid Route',404);
    }
}
