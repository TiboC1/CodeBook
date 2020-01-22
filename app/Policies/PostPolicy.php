<?php

namespace App\Policies;

use App\Profile;
use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
 
    public function update(User $user, post $post)
    {
        return $user->id == $post->user_id;
    }

    public function delete(User $user, post $post)
    {
        return $user->id == $post->user_id;
    }

}
