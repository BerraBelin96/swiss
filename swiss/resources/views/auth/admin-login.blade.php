@extends('layouts.master')

@section('content')
<div class="container">

    <form method="POST" class="form-signin" action="{{ route('admin.login.submit') }}">
        @csrf
        <h1>ADMIN Login</h1>
        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Adress" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <label for="password" class="sr-only">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>

        <hr>

        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </form>

</div>
@endsection
