<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_time', 'duration', 'qualification'];
    
    public function setDescriptionAttribute($value)
    {
        // Hapus semua tag HTML dan simpan hanya teks biasa
        $this->attributes['description'] = strip_tags($value);
    }

    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function leaderboards()
    {
        return $this->hasMany(Leaderboard::class);
    }
    public function questionTaken()
    {
        return $this->hasMany(QuestionTaken::class);
    }

    public function round()
    {
        return $this->hasMany(Round::class);
    }

    public function waiting()
    {
        return $this->hasMany(Waiting::class);
    }
}