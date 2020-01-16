<?php

namespace App;

use App\User;
use App\Post;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage(){
        $imagePath = ($this->avatar) ? $this->avatar : 'profile/No_image_available.png';
        return '/storage/' . $imagePath;
        
    }

    public function bannerImage(){
        $imagePath = ($this->banner) ? $this->banner : 'profile/No_image_available.png';
        return '/storage/' . $imagePath;
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
