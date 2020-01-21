@extends('layouts.app')
@section('content')

<body>
<!-- profile header -->
    <div class="container-fluid">
        <div class="rowProfile">
            <div class="col-md-12">
                <div class="fb-profile-block">
                    <div class="h-100 d-inline-block fb-profile-block-thumb cover-container"></div>
                    <img class="banner" src="{{$user->profile->bannerImage()}}" style="height:300px">
                    <div class="profile-img">
                        <a href="#">
                            <img src="{{$user->profile->profileImage()}}" alt="" class="rounded-circle" title="">
                        </a>
                    </div>
                    <div class="profile-name">

                        <h2>{{$user->profile->nickname}}</h2>
<!-- user can edit his own profile and make a post-->
                        @if (Auth::user()->id == $user->profile->id)
                        <a href="{{route('profile.edit', $user)}}" class="btn btn-info" role="button">Edit profile</a>
                        <span class="friendship"><a href="{{route('dashboard', $user)}}" class="btn btn-info" role="button">What's on your mind</a></span>
<!-- non users can follow this profile -->
                        @elseif (Auth::user()->id != $user->id)
                    
                    
                        <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                        @endif

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">

<!-- 1st column / profile info / public or private function on show -->

            <div class="col-md-3">
                <div class="container">
                    <div class="userinfo">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header">
                                <h1>Info</h1>
    
    <p>{{$followerCount}}</p>
    <p>{{$followingCount}}</p>

                            </div>
                            <ul class="list-group list-group-flush">
    @if (AUTH::user()->id == $user->id)

                                <li class="list-group-item">Born: <span> {{$user->profile->dob}}</span></li>
                                <li class="list-group-item">Gender: <span> {{$user->profile->gender}}</span></li>
                                <li class="list-group-item">Lives in: <span> {{$user->profile->city}}</span></li>
                                <li class="list-group-item">Education: <span> {{$user->profile->education}}</span></li>
                                <li class="list-group-item">Works at: <span> {{$user->profile->work}}</span></li>
                                <li class="list-group-item">Relationshipstatus: <span> {{$user->profile->relationship}}</span></li>
                                <li class="list-group-item">Description: <span> {{$user->profile->description}}</span></li>

    @else
        @if ($user->profile->priDob == 0)
                                <li class="list-group-item">Born: <span> {{$user->profile->dob}}</span></li>
        @else
                                <p>Private</p>                                
        @endif
                                <li class="list-group-item">Gender: <span> {{$user->profile->gender}}</span></li>
                                
        @if ($user->profile->priCity == 0)
                                
                                <li class="list-group-item">Lives in: <span> {{$user->profile->city}}</span></li>
        @else
                                <p>Private</p>  
        @endif                              
        @if ($user->profile->priEducation == 0)
                                
                                <li class="list-group-item">Education: <span> {{$user->profile->education}}</span></li>
        @else
                                <p>Private</p>
        @endif
        @if ($user->profile->priWork == 0)
                                
                                <li class="list-group-item">Works at: <span> {{$user->profile->work}}</span></li>
        @else
                                <p>Private</p>
        @endif
        @if ($user->profile->priRelationship == 0)
                                
                                <li class="list-group-item">Relationshipstatus: <span> {{$user->profile->relationship}}</span></li>
        @else
                                <p>Private</p>
        @endif
                                <li class="list-group-item">Description: <span> {{$user->profile->description}}</span></li>
    @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

<!-- 2nd column / 5 most recent posts and pagination -->

            <div class="col-md-6">
                <div class="row">

                    <div class="card" style="width: 39rem;">
                        <div class="card-header">
                            <h1>Timeline</h1>
                        </div>
                    </div>

                    @foreach ($posts as $post)

                   

                    <div class="card col-md-10">
                        @if (isset($post->image))
                        <img src="{{$post->image}}" class="card-img-top" alt="posted image">
                        @endif
                         <h2>{{$post->title}}</h2>
                             <div class="card-body">
                                 <p class="card-text">{{$post->body}}</p>
                             </div>
                    </div>

                    @endforeach
                    <!-- pagination -->
                    <div class="row col-md-12">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>

            <!-- 3rd column/  -->
            <div class="col-md-3">
                <div class="photos">
                    <div class="container">
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header">
                                    <h1>Photos</h1>
                                </div>
                            </div>
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