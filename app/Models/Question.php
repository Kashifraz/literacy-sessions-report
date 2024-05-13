<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order_id',
        'strongly_agree',
        'agree',
        'disagree',
        'strongly_disagree',
        'no_response',
    ];

    public function literacysession()
    {
        return $this->belongsTo(LiteracySession::class);
    }
}
