<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id','round_id', 'selected_option', 'responses_time', 'is_correct', 'points'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function leaderboard()
    {
        return $this->belongsTo(Leaderboard::class);
    }
}