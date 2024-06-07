<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'state_id', 'price', 'promo'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
