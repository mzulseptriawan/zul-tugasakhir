<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (auth() -> user() -> level == 3 && auth() -> user() -> status == "Aktif"){
            return $next($request);
        }
        abort(403, "Anda tidak memiliki akses Anggota/Akun anda dinonaktifkan.");
    }
}
