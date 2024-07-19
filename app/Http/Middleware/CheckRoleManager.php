<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;


class CheckRoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cekuser = AUTH::user();
        if(isset($cekuser->id)){
            if ($cekuser->role_is == 2) {
                return redirect()->route('dashboard_kasir');
            }
        }
        return $next($request);
    }
}
