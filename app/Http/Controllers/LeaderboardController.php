<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index($roundId)
    {
        $round = Round::with('leaderboards.user')->findOrFail($roundId); 
        $qualification = $round->qualification;

        // Ambil leaderboard sesuai qualification, dengan response_time
        $leaders = $round->leaderboards()
            ->orderByDesc('score')
            ->orderBy('responses_time')
            ->take($qualification)
            ->get();

        // Semua leaderboard untuk mencari peringkat user login
        $allLeaders = $round->leaderboards()
            ->where('score', '>', 0)
            ->orderByDesc('score')
            ->get();
        $userId = auth()->id();
        // foreach ($allLeaders as $Leaders){
        //   if ($Leaders->user_id == $userId) { // Bandingkan user_id dalam leaderboard dengan user login
        //         dd($Leaders); // Debug: Tampilkan data leaderboard milik user login
        //     }
        // }
        // Peringkat user login
        $loggedInUserRank = $allLeaders->search(fn($leader) => $leader->user_id == $userId && $leader->score > 0) + 1;

        // Cek apakah user login dalam qualification
        $isInQualification = $leaders->contains(fn($leader) => $leader->user_id == $userId && $leader->score > 0);
        return view('user.leaderboard', [
            'leaders' => $leaders,
            'loggedInUserRank' => $loggedInUserRank,
            'qualification' => $qualification,
            'isInQualification' => $isInQualification,
            'round' => $round
        ]);
    }
}