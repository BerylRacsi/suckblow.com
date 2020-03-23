@extends('layouts.master')

@section('content')

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="login_box_img">
          <div class="hover">
            <h4>New to our website?</h4>
            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
            <a class="button button-account" href="{{url('/register')}}">Create an Account</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="login_form_inner">
          
          @isset($url)
          <h3>Partner Login</h3><br>
          <a href="{{url('login/')}}">
            or Login as User
          </a>

          <form method="POST" class="row login_form" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">

          @else
          <h3>User Login</h3><br>
          <a href="{{url('login/partner')}}">
            or Login as Partner
          </a>

          <form method="POST" class="row login_form" action="{{ route('login') }}" aria-label="{{ __('Login') }}">

          @endisset
            @csrf

            <div class="col-md-12 form-group">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-md-12 form-group">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-md-12 form-group">
              <div class="creat_account">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Keep me logged in</label>
              </div>
            </div>

            <div class="col-md-12 form-group">
              <button type="submit" class="button button-login w-100">Log In</button>
              @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                      {{ __('Forgot Password?') }}
                  </a>
              @endif
            </div>

            <div class="col-md-12 form-group">
              <button class="button w-100" style="border: 0; border-radius: 0; background-color: #c5322d;">
                <i class="fab fa-google"></i>
                | Sign in with Google
              </button>
            </div>
            <div class="col-md-12 form-group">
              <button class="button w-100" style="border: 0; border-radius: 0;">
                <i class="fab fa-facebook"></i>
                | Sign in with Facebook
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Login Box Area =================--> 

@endsection