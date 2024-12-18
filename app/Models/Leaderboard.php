<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'round_id',
        'user_id',
        'rank',
        'total_points',
        'is_correct',
        'qualification',
        'responses_time',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function questionTaken()
    {
        return $this->belongsTo(QuestionTaken::class, 'round_id', 'round_id');
    }
}