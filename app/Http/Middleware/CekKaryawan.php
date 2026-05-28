<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekKaryawan
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('karyawan_login')) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}
