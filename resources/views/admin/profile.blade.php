@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>Edit your info</h1>
        <a class="cool_button" href="{{ route('admin.admin') }}">Previous Page</a>
    </div>
    <div class="error">
        @if($errors->any())
            {{ $errors->first() }}
        @endif
    </div>
    <form method="POST" action="{{ route('admin.profile') }}">
        @csrf

        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">

        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}">

        <label for="password">Set a new Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="show_pass"><input type="checkbox" onclick="showPassword()"><p>Show Password</p></div>

        <button type="submit" class="cool_button">Update Info</button>
    </form>
@endsection
