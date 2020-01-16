<?php

namespace App;

use App\Profile;
use App\User;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    //link to user

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
