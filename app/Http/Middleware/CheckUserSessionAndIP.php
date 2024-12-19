<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserSessionAndIP
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = Session::getId();
            $currentIP = $request->ip();

            // Memeriksa apakah sesi berbeda dengan sesi yang tersimpan di database
            if ($user->session_id && $user->session_id !== $currentSessionId) {
                // Update session_id dan last_ip menjadi null sebelum logout
                Auth::guard('web')->logout();
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'session_id' => null,
                        'last_ip' => null,
                    ]);
                return redirect('/login')->withErrors('Akun Anda sedang digunakan di perangkat lain.');
            }

            // Memeriksa apakah IP berbeda dengan IP yang tersimpan di database
            if ($user->last_ip && $user->last_ip !== $currentIP) {
                // Update session_id dan last_ip menjadi null sebelum logout
                Auth::guard('web')->logout();
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'session_id' => null,
                        'last_ip' => null,
                    ]);
                return redirect('/login')->withErrors('Akun Anda sedang digunakan di alamat IP lain.');
            }

            // Update session_id dan last_ip
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'session_id' => $currentSessionId,
                    'last_ip' => $currentIP
                ]);
        }

        return $next($request);
    }
}

