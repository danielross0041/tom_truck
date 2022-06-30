@extends('layouts.main')
@section('content')
<div class="login-bg-image">
    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">
                <form method="POST" action="{{ route('login') }}" class="row row-eq-height lockscreen mt-5 mb-5">
                    @csrf
                    <div class="lock-image col-12 col-sm-5">
                        <img src="{{asset('images/login-image.webp')}}" class="login-space-image">
                    </div>
                    <div class="login-form col-12 col-sm-7">
                        <div class="form-group mb-3">
                            <label for="emailaddress">{{ __('E-Mail Address') }}</label>

                            <input id="emailaddress" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password" />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{--
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="checkbox-signin">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        --}}
                        <div class="form-group mb-0">
                            <button class="btn btn-primary" type="submit">Log In</button>
                            {{-- 
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                            --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection