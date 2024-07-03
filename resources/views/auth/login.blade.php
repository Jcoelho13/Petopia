@extends('layouts.app')

@section('content')
<div class="error">
    @if($errors->any())
        {{ $errors->first() }}
    @endif
</div>
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <label for="email">E-mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>
    <button class="cool_button" type="submit">
        Login
    </button>
</form>
    <a class="cool_button" href="{{ route('recover.password') }}">
        Forgot Your Password?
    </a>
@endsection