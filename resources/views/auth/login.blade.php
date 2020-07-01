@extends('layouts.login')

@section('title')
    LOGIN
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <img src="log-reg/img/avatar.svg">
        @error('email')
            <span class="error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @error('password')
            <span class="error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Email</h5>
                <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
        </div>
        <div class="input-div pass">
            <div class="i"> 
                 <i class="fas fa-lock"></i>
            </div>
            <div class="div">
                 <h5>Password</h5>
                 <input id="password" type="password" class="input" name="password" required autocomplete="current-password">
         </div>
         
        </div>
        <div class="div-remember">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="remember-me" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <button type="submit" class="btn">
            {{ __('Login') }}
        </button>

        <a class="" href="{{ route('register') }}">Create account</a>
    </form>
@endsection
