<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckIfInWaitingRoom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada session round ID yang sedang aktif
        $roundId = $request->session()->get('current_round_id');

        if ($roundId) {
            // Ambil waktu selesai dari session untuk round tersebut
            $endTime = session("round_{$roundId}_waitTime");

            // Log waktu untuk debugging
            Log::debug("Round ID: {$roundId}");
            Log::debug("End Time: {$endTime}");
            Log::debug("Current Time: " . Carbon::now()->timestamp);

            // Periksa apakah session waktu selesai ada dan apakah waktu saat ini masih sebelum waktu selesai
            if ($endTime && Carbon::now()->timestamp < $endTime) {
                // Jika masih dalam waiting room, redirect ke halaman waiting room
                return redirect()->route('user.waiting', ['roundId' => $roundId]);
            }
        }

        // Jika tidak dalam waiting room, lanjutkan ke request berikutnya
        return $next($request);
    }

}
