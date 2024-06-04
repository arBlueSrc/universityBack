<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'rate','user_id'];

//    public function userAnswer()
//    {
//        return $this->belongsTo(UserAnswer::class);
//    }
}
