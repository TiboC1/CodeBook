@extends('layouts.app')
<!-- implement navbar, header, ... here -->

@section('content')



<p>{{$post->user_id}}</p>
<p>{{$user->id}}</p>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit post') }}</div>

                <div class="card-body">
                    @if($post->user->id == Auth::user()->id)
                    <form method="POST" enctype='multipart/form-data' action='/post/{{$post->id}}'>
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="{{ Session::token() }}" name="_token">
                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input type="text" id="title" name="title" value="{{ $post->title}}">

                            <textarea class="form-control" name="body" rows="5" value="{{ $post->body}}"></textarea>
                            <input type="file" name= "image" class="form-control" value="{{ $post->image}}">
                        </div>    
                        <input type="submit" class="btn btn-primary" value="Post">
                            
                    </form>
                    <form action="{{route('post.delete', $post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <h3 class="alert">Delete Post</h3>
                    <input type="submit" value="delete">
                    
                    </form>
                    @else
                    <h1>{{Auth::user()->name}}, GTFO you wannabe hacker!</h1>                   
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

<!-- implement footer here -->