@extends('layouts.app')
@section('content')
    @if ($errors->has('invalid_email'))
        <div class="alert alert-danger">
            {{ $errors->first('invalid_email') }}
        </div>
    @endif
    <div class="password-recovery-form">
        <h2>Password Recovery</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="email-form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button class="cool_button" type="submit">Send Password Reset Email</button>
        </form>
    </div>
@endsection