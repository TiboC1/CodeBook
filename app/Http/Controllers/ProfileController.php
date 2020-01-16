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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct(){

        $this->middleware('auth');

        }

     public function index()
    {
        $profiles=Profile::latest()->get();
        dd($profiles);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/profile/store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

            return view('profile', compact('user', 'profile'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile, User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $followerCount = Cache::remember('count.posts.' . $user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->profile->followers->count();
            });
            
        $followingCount = Cache::remember('count.posts.' . $user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->following->count();
            });

            $posts = DB::table('posts')->paginate(5);

            return view("/profile/show", compact('user', 'posts', 'follows', 'profile', 'followerCount', 'followingCount'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile, User $user)
    {
        $profile= Profile::find($user->id);
        return view('/profile/edit', compact('user','profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile, User $user)
    {
        $this->authorize('update',$user->profile);
        
        $data = request()->validate([
             'nickname' => '',
             'dob' => 'before:today',
             'gender' => '',
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
             'banner' => 'image|mimes:jpeg,png,jpg,gif,svg',
             'description' => '',
             'city' => '',
             'relationship' => '',
             'work' => '',
             'education' => '',
             'pri-dob' => '',
             'pri-city' => '',
             'pri-relationship' => '',
             'pri-work' => '',
             'pri-education' => '',
            
            ]);
            
            if(request('banner')){
                $bannerPath = request('banner')->store('profile', 'public');
                $banner = Image::make(public_path("storage/{$bannerPath}"))->fit(1500, 600);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile, User $user)
    {
        $users = User::findOrFail($user->id);
        $users->profile()->delete();
        $users->post()->delete();
        $users->delete();

        return redirect('/');
    }

}
