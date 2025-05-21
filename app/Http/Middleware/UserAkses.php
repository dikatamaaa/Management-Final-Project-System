<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if(Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'admin':
                        return redirect('/admin/beranda');
                    case 'mahasiswa':
                        return redirect('/mahasiswa/beranda');
                    case 'dosen':
                        return redirect('/dosen/beranda');
                    default:
                        return redirect('/login');
                }
            }
        }
        return $next($request);
    }
}
