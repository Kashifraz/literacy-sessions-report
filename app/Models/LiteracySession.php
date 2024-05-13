<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiteracySession extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'attendees',
        'participants',
        'identity',
        "topic",
        "department",
        "program",
        "campus",
        "conductedby",
        "images",
        "answers",
        "sessiondate",
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
