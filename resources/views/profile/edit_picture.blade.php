@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Picture</li>
        </ol>
        @endsection
@section('content')
    <div id="edit_pic_form">
        <h1>Edit Profile Picture</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="flexbox_edit_pic">
            <div class="profile_image">
                <img src="{{ URL::asset($user->profile_image) }}" alt="Profile Picture">
            </div>
            <form method="POST" action="{{ route('profile.updatePicture') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="profile_image"></label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                </div>
                <button type="submit" class="details-button">Update Profile Picture</button>
            </form>
        </div>
    </div>
@endsection
