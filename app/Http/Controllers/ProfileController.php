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
        return view('/main/home', compact ('user', 'profile'));
    }
    public function registerRedirect(User $user, Profile $profile){
        $user=Auth::user();
        return redirect('profile/'.$user->id.'/edit');
    }

     public function index()
    {
        $profiles=Profile::latest()->get();
        dd($profiles);

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
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $followerCount =  $user->profile->followers->count();
        $followingCount =  $user->following->count();
        $posts = DB::table('posts')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        return view("/profile/show", compact('user', 'posts', 'follows', 'profile', 'followerCount', 'followingCount'));

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
        $users = User::findOrFail($user->id);
        $users->profile()->delete();
        $users->post()->delete();
        $users->delete();

        return redirect('/');
    }

}
