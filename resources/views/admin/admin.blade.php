@extends('layouts.admin_app')

@section('content')
    <h1>Welcome to your dashboard, {{ Auth::user()->name }}!</h1>
    <div class="p_container">
        <p>See users<a class="cool_button" href="{{ url('/admin/users') }}">→</a></p>
        <p>See products<a class="cool_button" href="{{ url('/admin/products') }}">→</a></p>
        <p>See categories<a class="cool_button" href="{{ url('/admin/categories') }}">→</a></p>
        <p>Edit your information<a class="cool_button" href="{{ url('/admin/profile') }}">→</a></p>
    </div>
@endsection