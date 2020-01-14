<?php

namespace App\Http\Controllers;

use App\Profile;

use App\User;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //dd($profiles);

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
        dump(request()->all());
        // $validatedData=$request->validate([
        //     'dob'=> 'date_format:DD-MM-YYYY|before:today',
        //     'avatar'=>'image',
        //     'banner' =>'image',
            
        //     ]);
            
            // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            // $image->save();
            
            //auth()->user()->posts()->update();
            $profile= new Profile;
            $profile->user_id=Auth::id();
            // $profile->dob=request('dob');            
            // $profile->gender=request('gender');
            // $profile->avatar=request('avatar');
            // $profile->banner=request('banner');
            // $profile->description=request('description');
            // $profile->city=request('city');
            // $profile->relationship=request('relationship');
            // $profile->work=request('work');
            // $profile->education=request('education');
            $profile->save();

            return view('profile', compact('user', 'profile'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $target= Profile::find($profile->id);
        //dd($target);
        // return view('profile',[
        //     'profile'=>$target
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile, User $user)
    {

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
            'dob' => 'date_format:DD-MM-YYYY|before:today',
            'gender' => '',
            'avatar' => '',
            'banner' => '',
            'description' => '',
            'city' => '',
            'relationshipstatus' => '',
            'work' => '',
            'education' => '',
            
            ]);
            
            //$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            //$image->save();
            
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
