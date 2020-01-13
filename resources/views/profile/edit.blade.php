@extends('layouts.app')
<!-- implement navbar, header, ... here -->

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="/profile/{{$user->id}}">
                        @csrf

<div class="form-group row">
<label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
<input type="file" name="avatar" placeholder="Upload an avatar" /><br />
                        
</div>
<div class="form-group row">

                            <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
                            
                            <input type="file" name="banner" placeholder="Upload a banner" /><br />
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>


                            <div class="col-md-6">
                                <select>
                                <option value="undefined">Undefined</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" name="" value=>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id = "myTextArea"
                  rows = "6"
                  cols = "34">Your text here</textarea>
                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="" name="city" value="">

                            
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="work" class="col-md-4 col-form-label text-md-right">{{ __('Work') }}</label>

                            <div class="col-md-6">
                                <input id="work" type="text" class="" name="work">

                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}</label>

                            <div class="col-md-6">
                                <input id="education" type="text" class="" name="education" value="">
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="relationshipstatus" class="col-md-4 col-form-label text-md-right">{{ __('Relationship status') }}</label>


                            <div class="col-md-6">
                                <select>
                                <option value="single">Single</option>
                                <option value="dating">Dating</option>
                                <option value="engaged">Engaged</option>
                                <option value="married">Married</option>
                                <option value="complicated">It's complicated</option>
                                </select>
                                
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='container'>
<div class='row justify-content-start'>
<img src="/frankenprofile.jpg">

</div>



</div>




@endsection

<!-- implement footer here -->