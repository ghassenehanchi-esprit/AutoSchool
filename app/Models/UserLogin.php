<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserLogin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userlogins';



    /**
     * Define a many-to-one relationship with the User model.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
