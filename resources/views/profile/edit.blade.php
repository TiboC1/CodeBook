@extends('layouts.app')
<!-- implement navbar, header, ... here -->

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit profile') }}</div>

                <div class="card-body">
                    @if($user->id == Auth::user()->id)
                    <form method="POST" enctype='multipart/form-data' action='/profile/{{$user->id}}'>
                        @csrf
                        @method('PATCH')

                            <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                            <input type="file" name="avatar" placeholder="Upload an avatar" value="{{ old('avatar') ?? $profile->avatar}}" /><br />
                                                    
                            </div>
                            <div class="form-group row">

                            <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
                            
                            <input type="file" name="banner" placeholder="Upload a banner" value="{{ old('banner') ?? $profile->banner}}"/><br />
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>


                            <div class="col-md-6">
                                <select id="gender" name="gender" value="{{ old('gender') ?? $profile->gender}}">
                                <option value="undefined"{{ $profile->gender == 'undefined' ? 'selected' : '' }}>Undefined</option>
                                <option value="female"{{ $profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male"{{ $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" name="dob" value="{{$profile->dob}}">
                                <input type="radio" id="pri-dob" name="pri-dob" value="0"> Public<br>
                                <input type="radio" id="pri-dob" name="pri-dob" value="1"> Private<br>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"  class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id = "description" name="description" value="{{ $profile->description}}"
                                rows = "6"
                                cols = "34">{{$profile->description}}</textarea>
                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="" name="city" value="{{$profile->city}}">
                                <input type="radio" id="pri-city" name="pri-city" value="0"> Public<br>
                                <input type="radio" id="pri-city" name="pri-city" value="1"> Private<br>

                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="" name="nickname" value="{{$profile->nickname}}">

                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="work" class="col-md-4 col-form-label text-md-right">{{ __('Work') }}</label>

                            <div class="col-md-6">
                                <input id="work" type="text" class="" name="work" value="{{$profile->work}}">
                                <input type="radio" id="pri-work" name="pri-work" value="0"> Public<br>
                                <input type="radio" id="pri-work" name="pri-work" value="1"> Private<br>

                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}</label>

                            <div class="col-md-6">
                                <input id="education" type="text" class="" name="education" value="{{$profile->education}}">
                                <input type="radio" id="pri-education" name="pri-education" value="0"> Public<br>
                                <input type="radio" id="pri-education" name="pri-education" value="1"> Private<br>
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="relationship" class="col-md-4 col-form-label text-md-right">{{ __('Relationship status') }}</label>

                            
                            <div class="col-md-6">
                                <select id="relationship" name="relationship">
                                <option value="single" {{ $profile->relationship == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="dating" {{ $profile->relationship == 'date' ? 'selected' : '' }}>Dating</option>
                                <option value="engaged" {{ $profile->relationship == 'engaged' ? 'selected' : '' }}>Engaged</option>
                                <option value="married" {{ $profile->relationship == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="complicated" {{ $profile->relationship == 'complicated' ? 'selected' : '' }}>It's complicated</option>
                                </select>
                                <input type="radio" id="pri-relationship" name="pri-relationship" value="0"> Public<br>
                                <input type="radio" id="pri-relationship" name="pri-relationship" value="1"> Private<br>
                                
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('profile.delete', $user)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <h3 class="alert">Delete Profile</h3>
                    <input type="submit" value="delete">
                    
                    </form>
                    @else
                    <h1>GTFO you wannabe hacker!</h1>                   
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

<!-- implement footer here -->