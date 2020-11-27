<?php

namespace App\Http\Middleware;

use Closure;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

        public function handle($request, Closure $next)
    {
        $role=auth()->user()->role;
        if ($role==0) {
            return $next($request);
        }else{
            return abort(403, 'Unauthorized action.');
        }

    }

}
