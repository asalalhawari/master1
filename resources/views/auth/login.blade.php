<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Glassmorphism</title>
    <link rel="stylesheet" href="{{ asset('assets1/css/stylelogin.css') }}">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>

            <!-- Email Address -->
            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <label>Enter your email</label>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-field">
                <input id="password" type="password" name="password" required>
                <label>Enter your password</label><br>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="forget">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <p>Remember me</p>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit">Log In</button>

            <!-- Register Link -->
            <div class="register">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
