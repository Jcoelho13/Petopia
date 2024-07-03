@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>Edit {{ $globalUser->name }}'s data</h1>
        <a class="cool_button" href="{{ route('admin.user', ['id' => $user->id]) }}">Previous Page</a>
    </div>
    <div class="error">
        @if($errors->any())
            {{ $errors->first() }}
        @endif
    </div>
    <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
        @csrf

        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $globalUser->name }}">

        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $globalUser->email }}">

        <label for="password">Set a new Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="show_pass"><input type="checkbox" onclick="showPassword()"><p>Show Password</p></div>

        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">

        <label for="wallet">Wallet</label>
        <input type="num    ber" step="0.01" class="form-control" id="wallet" name="wallet" value="{{ $user->wallet }}">

        <button type="submit" class="cool_button">Update User</button>
    </form>
@endsection
