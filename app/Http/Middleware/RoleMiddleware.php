<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Cek apakah user yang login memiliki role yang sesuai.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Jika user belum login, redirect ke login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Cek apakah role user termasuk dalam role yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            // Redirect ke halaman sesuai role-nya
            return redirect()->route($this->getHomeRoute($request->user()->role));
        }

        return $next($request);
    }

    /**
     * Dapatkan route home berdasarkan role user.
     */
    private function getHomeRoute(string $role): string
    {
        return match ($role) {
            'Owner' => 'owner.dashboard',
            'Capster' => 'capster.transaksi',
            default => 'login',
        };
    }
}
