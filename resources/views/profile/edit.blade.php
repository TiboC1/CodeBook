@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">{{ __('Edit profile') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
<div class="form-group row">

</div>
<div class="form-group row">
<label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
<input type="file" name="avatar" placeholder="Upload an avatar" /><br />

                            <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
                            
                            <input type="file" name="banner" placeholder="Upload a banner" /><br />
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id = "myTextArea"
                  rows = "6"
                  cols = "35">Your text here</textarea>
                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="city" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="work" class="col-md-4 col-form-label text-md-right">{{ __('Work') }}</label>

                            <div class="col-md-6">
                                <input id="work" type="work" class="form-control @error('password') is-invalid @enderror" name="work" required autocomplete="current-password">

                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>


                            <div class="col-md-6">
                                <select> id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="undefined">Undefined</option>
                                </select>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection