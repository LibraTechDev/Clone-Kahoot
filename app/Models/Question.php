<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'image', 'option', 'correct_option', 'round_id',

    ];

    protected $casts = [
        'options' => 'array', // Field 'options' akan otomatis di-cast menjadi array
    ];

    public function setDescriptionAttribute($value)
    {
        // Hapus semua tag HTML dan simpan hanya teks biasa
        $this->attributes['content'] = strip_tags($value);
    }
    
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    
}