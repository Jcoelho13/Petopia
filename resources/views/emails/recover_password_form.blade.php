<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h1>Reset Password</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('update.password', ['token' => $token]) }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <label for="password">New Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="password_confirmation">Confirm Password:</label><br>
    <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

    <button type="submit">Reset Password</button>
</form>
</body>
</html>
