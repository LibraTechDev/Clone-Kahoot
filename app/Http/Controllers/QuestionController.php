<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Leaderboard;
use App\Models\Waiting;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\QuestionTaken;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function showQuestion($roundId, $questionIndex = 0)
    {
        $userId = auth()->id();

        // Validasi akses round
        $questionTaken = QuestionTaken::where('user_id', $userId)
            ->where('round_id', $roundId)
            ->where('status', 'unlocked')
            ->first();

        if (!$questionTaken) {
            return redirect()->route('user.level')
                ->withErrors('Anda tidak memiliki akses ke round ini.');
        }

        $round = Round::with('questions')->findOrFail($roundId);
        $totalQuestions = $round->questions->count();

        // Validasi indeks pertanyaan
        if ($questionIndex < 0 || $questionIndex >= $totalQuestions) {
            return redirect()->route('user.round', $roundId)
                ->withErrors('Invalid question index.');
        }

        $question = $round->questions[$questionIndex];
        $duration = $round->duration;

        // Kelola waktu mulai round
        $startTime = session("round_{$roundId}_startTime", now());
        session(["round_{$roundId}_startTime" => $startTime]);

        // Hitung sisa waktu
        $timeElapsed = now()->diffInSeconds($startTime);
        $timeLeft = max(0, $duration - $timeElapsed);

        if ($timeLeft <= 0) {
            $questionTaken->update(['status' => 'completed']);
            return redirect()->route('user.waiting')
                ->withErrors('Waktu round telah habis.');
        }

        return view('user.question', [
            'round' => $round,
            'question' => $question,
            'currentIndex' => $questionIndex,
            'totalQuestions' => $totalQuestions,
            'duration' => $timeLeft,
        ]);
    }

    public function submit(Request $request, $roundId)
    {
        // dd($request->all(), $roundId);
        $userId = auth()->id();

        // Ambil jawaban sementara dari session
        $temporaryAnswers = session()->get("round_{$roundId}_answers", []);

        // Validasi round dan status
        $questionTaken = QuestionTaken::where('user_id', $userId)
            ->where('round_id', $roundId)
            ->where('status', 'unlocked')
            ->first();

        if (!$questionTaken) {
            return redirect()->route('user.level')
                ->withErrors('Anda tidak memiliki akses ke round ini.');
        }


        $startTime = session("round_{$roundId}_startTime", now());
        $endTime = now();
        $responseTime = $endTime->diffInSeconds($startTime);

        // Ambil daftar soal yang dijawab dan opsi yang dipilih
        $totalQuestions = Question::where('round_id', $roundId)->count();
        $selectedOptions = $request->input('selected_option', []) + $temporaryAnswers;
        // Variabel untuk menghitung jumlah soal yang benar
        $correctAnswers = 0;
        $totalPoints = 0; // Total poin yang benar

        // Proses dan simpan setiap jawaban
        foreach ($selectedOptions as $questionId => $selectedOption) {
            $question = Question::findOrFail($questionId);

            $isCorrect = $question->correct_option == $selectedOption;
            $points = $isCorrect ? 10 : 0; // Jika benar, beri 10 poin; jika salah beri 0 poin

            // Simpan jawaban ke database
            Answer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'round_id' => $roundId,
                'selected_option' => $selectedOption,
                'responses_time' => $responseTime,
                'is_correct' => $isCorrect,
                'points' => $points
            ]);


            // Tambahkan poin jika jawaban benar
            $totalPoints += $points;
            if ($isCorrect) {
                $correctAnswers++;
            }
        }

        // Tentukan penalti berdasarkan waktu respons
        // $penalty = $responseTime * 0.5; 

        // Hitung skor
        $score = $totalQuestions > 0
            ? floor (($totalPoints / $totalQuestions) * 100 ) 
            : 0;

        //create waiting room
        $waitingEntry= Waiting::create([
            'round_id' => $roundId,
            'user_id' => $userId,
            'responses_time' => $responseTime,
            
        ]);
        
        // Update status round
        $questionTaken->update([
            'status' => 'completed',
            'score' => $score
        ]);
        $leaderboardEntry = Leaderboard::updateOrCreate(
            [
                'round_id' => $roundId,
                'user_id' => $userId,
            ],
            [
                'total_points' => $totalPoints,
                'is_correct' => $correctAnswers,
                'responses_time' => $responseTime,
                'score' => $score,
            ]
        );
        // Buka ronde berikutnya jika ada
        $nextRound = Round::where('id', '>', $roundId)
            ->orderBy('id', 'asc')
            ->first();

        if ($nextRound) {
            QuestionTaken::updateOrCreate(
                [
                    'user_id' => $userId,
                    'round_id' => $nextRound->id
                ],
                [
                    'status' => 'unlocked',
                    'score' => 0
                ]
            );
        }
        session(['current_round_id' => $roundId]);
        // Hapus session waktu mulai
        $request->session()->forget("round_{$roundId}_startTime");
   
        return redirect()->route('user.waiting', ['roundId' => $roundId]);
    }

    public function saveTemporaryAnswer(Request $request, $roundId)
    {
        $userId = auth()->id();
        $questionId = $request->input('question_id');
        $selectedOption = $request->input('selected_option');

        // Simpan jawaban ke session
        $temporaryAnswers = session()->get("round_{$roundId}_answers", []);
        $temporaryAnswers[$questionId] = $selectedOption;
        session()->put("round_{$roundId}_answers", $temporaryAnswers);

        return response()->json(['status' => 'success']);
    }
}