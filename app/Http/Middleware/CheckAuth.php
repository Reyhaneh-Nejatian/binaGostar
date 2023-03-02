<?php

namespace App\Http\Middleware;

use arghavan\RolePermissions\Models\Role;
use arghavan\User\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hasRole(Role::ROLE_USER))
        {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
