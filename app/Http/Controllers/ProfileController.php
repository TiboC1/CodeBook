<?php

namespace App\Http\Controllers;

use App\Profile;

use App\User;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
        
        $target= Profile::find($user->id);
        
        return view("/profile/show", compact('user', 'profile', 'target'));
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
             'avatar' => 'image',
             'banner' => 'image',
             'description' => '',
             'city' => '',
             'relationship' => '',
             'work' => '',
             'education' => ''
            
            ]);
            
            
            if(request('banner')){
                $bannerPath = request('banner')->store('profile', 'public');
                $banner = Image::make(public_path("storage/images/{$bannerPath}"))->fit(1000, 1000);
                $banner->save();
                $data = array_merge($data, ['banner' => $bannerPath]);
            }

            if(request('avatar')){
                $imagePath = request('avatar')->store('profile', 'public');
                $image = Image::make(public_path("storage/images/{$imagePath}"))->fit(1000, 1000);
                $image->save();
                $data = array_merge($data, ['avatar' => $imagePath]);
            }
            dd($data);
            auth()->user()->profile->update();

            return redirect("/profile/{$user->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
     //
    }
}
