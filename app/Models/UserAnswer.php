<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserAnswer extends Model
{
    use HasFactory;
    protected $table = "user_answer";

    protected $fillable = ['name', 'job', 'phone'];

    public function answer()
    {
        return $this->hasMany(Answer::class, "user_id");
    }
}
