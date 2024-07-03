@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>Create an user</h1>
        <a class="cool_button" href="{{ route('admin.users') }}">Previous page</a>
    </div>
    <div class="error">
        @if($errors->any())
            {{ $errors->first() }}
        @endif
    </div>
    <form method="POST" action="{{ route('admin.create.user') }}">
        @csrf
        @method('POST')

        <div class="row">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div class="row">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div class="row">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="row">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="row">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="row">
            <label for="is_Admin">Admin:</label>
            <input type="checkbox" id="is_Admin" name="is_Admin" value="1">
        </div>

        <p class="warning hidden" id="warning">Warning: The user will be created as an admin. This can have catastrophic consequences.</p>

        <button type="submit">Create Account</button>
    </form>
@endsection