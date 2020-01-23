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

        $users = auth()->user()->following()->pluck('profile_user.profile_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('/main/home', compact('user', 'profile', 'posts'));
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

        $users = auth()->user()->following()->pluck('profile_user.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        // return view

        return view('/main/home', compact('profile', 'user', 'posts'));
    }

    public function edit(Post $post, User $user){

        $user = Auth::user();
        return view('/post/edit', compact('user','post'));
    }
    public function update(Request $request, Post $post, User $user){
        
        $this->authorize('update',$post);
        
        $data = request()->validate([
             'title' => '',
             'body' => '',
             'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            
        $post->update($data);    //this updaes all posts from the user
        $user = Auth::user();
        //return "I just updated your post";
        return redirect("/profile/{$user->id}");
    }
  
    public function delete(Post $post, User $user)
    {

        $this->authorize('delete',$post);

        $post->delete();
        $user=auth()->user();
        return redirect("/profile/{$user->id}");
    }
    
}
