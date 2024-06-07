<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'image',
        'package_id',
    ];


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function quizDetails()
    {
        return $this->hasMany(QuizDetails::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
