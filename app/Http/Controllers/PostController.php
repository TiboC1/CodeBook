<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user, Profile $profile)
    {
        return view('/main/home', compact('user', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Profile $profile)
    {
        // validate the data from form

        $data = $request->validate([
            'title' => 'required|max:255',
            'body' => '',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // if the user uploads an image in post

        if (array_key_exists("image",$data)){

            $imagePath = request('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();
            $data = array_merge($data, ['image' => $imagePath]);
            // persist to database with image
            auth()->user()->post()->create([
                'title' => $data['title'],
                'body' => $data['body'],
                'image' => '/storage/'.$data['image']
    
            ]);
        }
        // persist to database without image
        else{
            auth()->user()->post()->create([
                'title' => $data['title'],
                'body' => $data['body'],
    
            ]);

        }



        // return view

        return view('/main/home', compact('profile', 'user'));
    }

    public function edit(Post $post, User $user){

        $user = Auth::user();
        return view('/post/edit', compact('user','post'));
    }
    public function update(Request $request, Post $post, User $user){
        
        $this->authorize('update',$user->post);
        
        $data = request()->validate([
             'title' => '',
             'body' => '',
             'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            
        auth()->user()->post->update($data);
        
        return redirect("/profile/{$user->id}");
    }
  
    public function delete(Post $post, User $user)
    {

        $this->authorize('delete',$user->post);

        $post->delete();

        return redirect('/main/home');
    }
    
}
