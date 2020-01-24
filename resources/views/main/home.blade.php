@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="fb-profile-block">
        <div class="h-100 d-inline-block fb-profile-block-thumb cover-container">
          <img class="banner" src="{{$user->profile->bannerImage()}}" style="height:300px">
            <div class="profile-img">
              <a href="{{ route('profile.show', $user)}}">
                <img src="{{$user->profile->profileImage()}}" alt="" class="rounded-circle" title="">
              </a>
            </div>
        </div>
        <div class="profile-name">
          <a href="{{ route('profile.show', $user)}}">
            <h2>{{$user->profile->nickname}}</h2>
          </a>
        </div>           
      </div>
    </div>
  </div>
</div>

<div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form action="{{ route('post.create', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ Session::token() }}" name="_token">
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" id="title" name="title">

                    <textarea class="form-control" name="body" rows="5" placeholder="Your Post"></textarea>
                    <input type="file" name= "image" class="form-control" placeholder="Image">
                </div>    
                <input type="submit" class="btn btn-primary" value="Post">
            </form>
</div>
@foreach ($posts as $post)
  <div class="card">
  @if ($post->image!="")
    <img src="{{$post->image}}" alt="posted image" width="300px">
  @endif
  <div class="card-body">
    <p>{{$post->user_id}}</p>
    <p class="card-title"><h4>{{$post->title}}</h4></p>
    <p class="card-text">{{$post->body}}</p>
  </div>
        
        
  </div>
@endforeach
        
     
               
     
          

@endsection

