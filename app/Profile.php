<?php

namespace App;

use App\User;
use App\Post;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    // display profile image function

    public function profileImage(){
        $imagePath = ($this->avatar) ? $this->avatar : 'profile/No_image_available.png';
        return '/storage/' . $imagePath;
    
    }

    // display banner image function

    public function bannerImage(){
        $bannerPath = ($this->banner) ? $this->banner : 'profile/No_banner_available.png';
        return '/storage/' . $bannerPath;
        
    }

    //link to user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // link to followers

    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
