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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="fb-profile-block">
                    
                    <div class="fb-profile-block-thumb cover-container"></div>
                    <div class="profile-img">
                        <a href="#">
                            <img src="{{$user->profile->profileImage()}}" alt="" class="rounded-circle" title="">
                        </a>
                    </div>
                    <div class="profile-name">
                        <h2>first/last</h2>
                        <a href="" class="btn btn-info" role="button">Edit profile</a>
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
            <div class="col-md-4">
                <div class="userinfo">
                    <h4>user info</h4>
                    <p>hello world</p>

                </div>
            </div>
            <div class="col-md-4">
                <div class="feed">
                    <h4>post & feeds</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="advertisement">
                    <div class="container">
                        <div class="row">
                            <h4>Ads</h4>
                        </div>
                        <div class="row">
                            <img src="/images/5ac4c81f132ad.jpeg">
                        </div>
                        <div class="row">
                            <img src="/images/maxresdefault.jpg">

                        </div>
                        <div class="row">
                            <img src="/images/o0pfd.jpg">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


@endsection