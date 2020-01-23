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
                            <img src="{{$user->profile->profileImage()}}" alt="problem loading your avatar" class="rounded-circle" title="">

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
                            </div>
                            <ul class="list-group list-group-flush">

                <!-- display if it's user's own profile -->

    @if (AUTH::user()->id == $user->id)

                                <li class="list-group-item">Born: <span> {{$user->profile->dob}}</span></li>
                                <li class="list-group-item">Gender: <span> {{$user->profile->gender}}</span></li>
                                <li class="list-group-item">Lives in: <span> {{$user->profile->city}}</span></li>
                                <li class="list-group-item">Education: <span> {{$user->profile->education}}</span></li>
                                <li class="list-group-item">Works at: <span> {{$user->profile->work}}</span></li>
                                <li class="list-group-item">Relationshipstatus: <span> {{$user->profile->relationship}}</span></li>
                                <li class="list-group-item">Description: <span> {{$user->profile->description}}</span></li>
                                <li class="list-group-item">Following: <span> {{$followingCount}}</span></li>
                                <li class="list-group-item">Followers: <span> {{$followerCount}}</span></li>

                <!-- display if it's NOT user's own profile -->

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
                                <li class="list-group-item">Following: <span> {{$followingCount}}</span></li>
                                <li class="list-group-item">Followers: <span> {{$followerCount}}</span></li>
                            </ul>
    @endif

                        </div>

                        @if ($user->profile->priFollowers == 0)

                    <!-- List of Followers -->

                        <div class="card  my-3" style="width: 18rem;">
                            <div class="card-title">
                                <h3 class="text-center py-1">List of Followers</h2>
                            </div>
                            <ul class="list-group list-group-flush">

                            @foreach ($followers as $follower)

                            <li class="list-group-item">
                                <a href="{{ route ('profile.show', $follower->id) }}">
                                    <img class="rounded-circle" style="width: 35px" src="{{$follower->profile->profileImage()}}"> 
                                    <span>{{$follower->name}}</span>
                                </a>
                            </li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        @if ($user->profile->priFollowing == 0)

                    <!-- List of Following -->

                        <div class="card my-3" style="width: 18rem;">
                            <div class="card-title">
                                <h3 class="text-center py-1">List of Following</h2>
                            </div>

                            <ul class="list-group list-group-flush">

                            @foreach ($following as $follow)

                            <li class="list-group-item">
                                <a href="{{ route ('profile.show', $follow->id) }}">
                                    <img class="rounded-circle" style="width: 35px" src="{{$follow->profileImage()}}"> 
                                    <span>{{$follow->user->name}}</span>
                                </a>
                            </li>
                            @endforeach
                            </ul>                            
                        </div>

                        @endif

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
                    <p>{{$post->updated_at}}</p>
                        @if (isset($post->image))
                        <img src="{{$post->image}}" class="card-img-top" alt="posted image">
                        @endif
                         <h2>{{$post->title}}</h2>
                             <div class="card-body">
                                 <p class="card-text">{{$post->body}}</p>
                             </div>
                            <a href="../../post/{{$post->id}}/edit"><button> Edit</button></a>
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
                        </div>
                        <div class="row">
                            @foreach ($images as $image)

                            <img src="{{$image->image}}">

                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection