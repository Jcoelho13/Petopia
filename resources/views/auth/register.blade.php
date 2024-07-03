@extends('layouts.app')

@section('content')
<div class="error">
  @if($errors->any())
    {{ $errors->first() }}
  @endif
</div>
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="first_name">First Name</label>
    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>


    <label for="last_name">Last Name</label>
    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>


    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>


    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>


    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button class="authentication" type="submit">
      Register
    </button>
</form>
@endsection