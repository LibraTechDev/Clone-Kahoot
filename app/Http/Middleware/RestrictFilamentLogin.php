<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Filament\Http\Controllers\AssetController;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse;

class RestrictFilamentLogin
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
        $allowedIPs = config('ip_whitelist.allowed_ips');
        if (!in_array($request->ip(), $allowedIPs)) {
            Log::info('Unauthorized IP attempt: ' . $request->ip());
            Log::info('Middleware RestrictFilamentLogin terpanggil');
            abort(403, 'Unauthorized access.');
        } else {
            Log::info('IP is allowed: ' . $request->ip());
            return $next($request);
        }
    }
}