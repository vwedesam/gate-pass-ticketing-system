@extends('layouts.app')

@section('content')
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            @include('inc.msg')
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="login100-form validate-form">
                @csrf
                <span class="login100-form-logo">
                    <img src="./assets/img/icon.jpg">
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    @if ($errors->has('username'))
                        <span class="alert alert-primary ">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="wrap-input100">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    @if ($errors->has('password'))
                        <span class="alert alert-primary ">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="container-login100-form-btn">
                    <button  type="submit" class="login100-form-btn">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
