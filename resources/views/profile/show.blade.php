@extends('layouts.app')
@section('content')
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashboard') }}">CodeBook</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="fb-profile-block">
                    
                    <div class="fb-profile-block-thumb cover-container"></div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="/images/frankenprofile.jpg" alt="" class="rounded-circle" title="">
                        </a>
                    </div>
                    <div class="profile-name">

                        <h2>{{$user->profile->nickname}}</h2>
                        <a href="" class="btn btn-info" role="button">Edit profile</a>
                        <span class="friendship"><a href="" class="btn btn-info" role="button">Want to be my friend?</a></span>

                    </div>

                    <div class="fb-profile-block-menu">
                        <div class="block-menu">
                            <ul>
                                <li><a href="#">Timeline</a></li>
                                <li><a href="#">Friends</a></li>
                                <li><a href="#">Photos</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="container">
                    <div class="userinfo">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header">
                                <h1>Info</h1>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Born: <span> {{$user->profile->dob}}</span></li>
                                <li class="list-group-item">Gender: <span> {{$user->profile->gender}}</span></li>
                                <li class="list-group-item">Lives in: <span> {{$user->profile->city}}</span></li>
                                <li class="list-group-item">Education: <span> {{$user->profile->education}}</span></li>
                                <li class="list-group-item">Works at: <span> {{$user->profile->work}}</span></li>
                                <li class="list-group-item">Relationshipstatus: <span> {{$user->profile->relationship}}</span></li>
                                <li class="list-group-item">Description: <span> {{$user->profile->description}}</span></li>
    <!-- upload description here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>What do you have to say?</h3></header>
                            <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
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
                </div>
                <div class="row">
                   

                    <div class="card col-md-12">
                         <h2>friends name and avatar</h2>
                             <div class="card-body">
                                 <p class="card-text">post</p>
                             </div>
                    </div>
                    <div class="card col-md-12">
                         <h2>friends name and avatar</h2>
                             <div class="card-body">
                                 <p class="card-text">post</p>
                             </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="advertisement">
                    <div class="container">
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <img src="/images/5ac4c81f132ad.jpeg" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <p class="card-text">First ad</p>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <img src="/images/maxresdefault.jpg" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <p class="card-text">Second ad</p>
                                    </div>
                            </div>                     
                        </div>
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <img src="/images/o0pfd.jpg" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <p class="card-text">Third ad</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection