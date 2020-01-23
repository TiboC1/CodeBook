@extends('layouts.app')
@section('content')
<body>
<div class="d-flex flex-wrap justify-content-between">
    @foreach ($profiles as $profile)
       <div class="px-3">
        <a href="/profile/{{$profile->id}}"><img class="rounded-circle" src="{{$profile->profileImage()}}" width="100px"  alt="avatar {{$profile->nickname}}">
        @if ($profile->nickname!="")
        <p class="text-center">{{$profile->nickname}}</p></a>
        @else
        <p class="text-center">{{$profile->user->username}}</p></a>
        @endif
       </div>
    @endforeach
</div>
</body>
@endsection