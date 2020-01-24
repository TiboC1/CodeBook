<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {

        // toggle between follow and unfollow

        return auth()->user()->following()->toggle($user->profile);
        
    }
}
