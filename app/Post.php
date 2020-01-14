<?php

namespace App;

use App\Profile;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}
