<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;
protected $table='quizzes';
    protected $fillable = [
        'user_id',
'order_id',
        'quizz_date',
        'quizz_score',
        'quizz_status',
    ];


    public function quizDetails()
    {
        return $this->hasMany(QuizDetails::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
