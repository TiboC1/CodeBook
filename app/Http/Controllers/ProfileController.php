<?php

namespace App\Http\Controllers;

use App\Profile;

use App\User;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    
     public function __construct()
     {

        $this->middleware('auth');

        }

    public function home(User $user, Profile $profile)
    {

        // instantiate user as authenticated user

        $user=Auth::user();

        // import relevant posts

        $users = auth()->user()->following()->pluck('profile_user.profile_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        // return view

        return view('/main/home', compact ('user', 'profile', 'posts'));
    }

// redirect new user after registration to profile edit page

    public function registerRedirect(User $user, Profile $profile){

        // instantiate user as authenticated user

        $user=Auth::user();

        // return view

        return redirect('profile/'.$user->id.'/edit');
    }

     public function index()
    {
        $profiles=Profile::get();
        return view('/index', compact('profiles'));

    }

    public function create()
    {
        return redirect('/profile/store');
    }



    public function store(Request $request, User $user)
    {

        // return view

            return view('profile', compact('user', 'profile'));

    }

// Show profile page

    public function show(Profile $profile, User $user, Post $posts)
    {
        // setting default follow status as false

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // fetching followers and following from database

        $followerCount =  $user->profile->followers->count();
        $followingCount =  $user->following->count();

        $followers = $user->profile->followers()->get();
        $following = $user->following()->get();

        // fetching and displaying relevant posts and images

        $posts = DB::table('posts')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $images = DB::table('posts')->where('user_id', $user->id)->where('image', '<>', '', 'and')->get();

        // return view

        return view("/profile/show", compact('user', 'posts', 'follows', 'profile', 'followerCount', 'followingCount', 'images', 'followers', 'following'));

    }

// edit User profile

    public function edit(Profile $profile, User $user)
    {

        // instantiate profile as authenticated user's profile

        $profile= Profile::find($user->id);

        // return view

        return view('/profile/edit', compact('user','profile'));
    }

// Update User profile

    public function update(Request $request, Profile $profile, User $user)
    {

        // authenticate user

        $this->authorize('update',$user->profile);

        // fetch and validate data from form in view
        
        $data = request()->validate([
             'nickname' => '',
             'dob' => '',
             'gender' => '',
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
             'banner' => 'image|mimes:jpeg,png,jpg,gif,svg',
             'description' => '',
             'city' => '',
             'relationship' => '',
             'work' => '',
             'education' => '',
             'priDob' => '',
             'priCity' => '',
             'priRelationship' => '',
             'priWork' => '',
             'priEducation' => '',
             'priFollowers' => '',
             'priFollowing' => '',
            
            ]);
            
        // if the user uploads a banner image

            if(request('banner')){
                $bannerPath = request('banner')->store('profile', 'public');
                $banner = Image::make(public_path("storage/{$bannerPath}"))->fit(1000, 1000);
                $banner->save();
                $data = array_merge($data, ['banner' => $bannerPath]);
            }

        // if the user uploads a profile image

            if(request('avatar')){
                $imagePath = request('avatar')->store('profile', 'public');
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
                $image->save();
                $data = array_merge($data, ['avatar' => $imagePath]);
            }

        // persist the validated data to database
        
            auth()->user()->profile->update($data);

        // return view

            return redirect("/profile/{$user->id}");
    }

// Delete User

    public function destroy(Profile $profile, User $user)
    {

        // authenticate user

        $this->authorize('delete',$user->profile);

        // fetch correct user row in database

        $deletedUser = User::findOrFail($user->id);

        // delete the user's profile

        $deletedUser->profile()->delete();

        // delete the user's posts

        $deletedUser->post()->delete();

        // delete user account

        $deletedUser->delete();

        // return view: landing page

        return redirect('/');
    }

}
