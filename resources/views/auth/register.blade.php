

@extends('layouts.login')

@section('title')
    Register
@endsection

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <img src="log-reg/img/avatar.svg">
        @error('email')
            <span class="error">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
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
                <h5>Name</h5>
                <input id="name" type="name" name="name" class="input" required autocomplete="email" autofocus>
            </div>
        </div>
        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Email</h5>
                <input id="email" type="email" name="email" class="input" required autocomplete="email" autofocus>
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
        <div class="input-div pass">
            <div class="i"> 
                    <i class="fas fa-lock"></i>
            </div>
            <div class="div">
                    <h5>Confirm password</h5>
                    <input id="password-confirm" type="password"  class="input" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn">
            {{ __('Register') }}
        </button>

        <a class="" href="{{ route('login') }}">Already have an account</a>
    </form>
@endsection
