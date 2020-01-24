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

    // display post image function
    
    public function postImage()
    {
        $imagePath = ($this->image) ? $this->image : 'uploads/No_image_available.png';
        return '/storage/' . $imagePath;
    }
}