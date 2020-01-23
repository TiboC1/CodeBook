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

    
     public function __construct(){

        $this->middleware('auth');

        }
    public function home(User $user, Profile $profile){
        $user=Auth::user();
        $users = auth()->user()->following()->pluck('profile_user.profile_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('/main/home', compact ('user', 'profile', 'posts'));
    }
    public function registerRedirect(User $user, Profile $profile){
        $user=Auth::user();
        return redirect('profile/'.$user->id.'/edit');
    }

     public function index()
    {
        $profiles=Profile::get();
        return view('/index', compact('profiles'));
        // //dd($profiles);
        // foreach ($profiles as $profile) {
        //     echo("</br><a href=/profile/".$profile->id.">".$profile->nickname."</a>");
        // }

    }

    public function create()
    {
        return redirect('/profile/store');
    }

    public function store(Request $request, User $user)
    {

            return view('profile', compact('user', 'profile'));

    }

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


        return view("/profile/show", compact('user', 'posts', 'follows', 'profile', 'followerCount', 'followingCount', 'images', 'followers', 'following'));

    }

    public function edit(Profile $profile, User $user)
    {
        $profile= Profile::find($user->id);
        return view('/profile/edit', compact('user','profile'));
    }

    public function update(Request $request, Profile $profile, User $user)
    {
        $this->authorize('update',$user->profile);
        
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
            
            if(request('banner')){
                $bannerPath = request('banner')->store('profile', 'public');
                $banner = Image::make(public_path("storage/{$bannerPath}"))->fit(1000, 1000);
                $banner->save();
                $data = array_merge($data, ['banner' => $bannerPath]);
            }

            if(request('avatar')){
                $imagePath = request('avatar')->store('profile', 'public');
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
                $image->save();
                $data = array_merge($data, ['avatar' => $imagePath]);
            }
            auth()->user()->profile->update($data);

            return redirect("/profile/{$user->id}");
    }

    public function destroy(Profile $profile, User $user)
    {

        $this->authorize('delete',$user->profile);

        $users = User::findOrFail($user->id);
        $users->profile()->delete();
        $users->post()->delete();
        $users->delete();

        return redirect('/');
    }

}
