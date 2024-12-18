<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Round;
use App\Models\Waiting;


class WaitingController extends Controller
{
    public function index($roundId)
    {
        // Ambil ronde berdasarkan ID
        $round = Round::findOrFail($roundId);
        // Ambil user yang sedang login
        $user = auth()->user();
        // Ambil response_time dari tabel waitings yang terkait dengan round_id dan user_id
        $waiting = Waiting::where('round_id', $roundId)
                      ->where('user_id', $user->id)
                      ->value('responses_time');
        $responseTime = $waiting;
        $roundDuration = $round->duration;
        $additionalWaitTime = 600;
        $totalWaitTime = max(0, $roundDuration - $responseTime) + $additionalWaitTime;
        // Periksa apakah waktu selesai sudah ada di session
        $endTime = session('round_'.$round->id.'_waitTime');
        if (!$endTime) {
            // Jika belum ada, hitung dan simpan waktu selesai di session
            $endTime = time() + $totalWaitTime;
            session(['round_'.$round->id.'_waitTime' => $endTime]);
        }
        // Cek apakah session berhasil disimpan
        $sessionValue = session('round_'.$round->id.'_waitTime');
        // Kirim data ke view
        return view('user.waiting', compact('round'));
    }
    

}