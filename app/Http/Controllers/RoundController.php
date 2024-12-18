<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Round;
use App\Models\QuestionTaken;

class RoundController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $user = Auth::user();
        $userProgress = QuestionTaken::where('user_id', $user->id)->first();
        $currentStage = $userProgress ? $userProgress->current_stage : 1;
        $score = QuestionTaken::where('user_id', $userId)->get();
        $rounds = Round::orderBy('id', 'asc')->get();

        return view('user.level', compact('rounds', 'currentStage', 'score'));
    }

    public function question($id)
    {
        // Ambil data round berdasarkan ID
        $round = Round::find($id);

        // Kirim data round ke view
        return view('user.question', compact('round'));
    }
    public function popup($RoundId)
    {
        $round = Round::find($RoundId);
        return view('user.popup', compact('round'));

    }
    public function waitingRoom($RoundId)
    {
        $round = Round::find($RoundId);
        return view('user.waiting', compact('round'));
    }
}