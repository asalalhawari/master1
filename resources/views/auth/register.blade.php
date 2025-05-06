<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('assets1/css/stylelogin.css') }}">
</head>
<body>
  <div class="wrapper">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <h2>Register</h2>
       @if (session('status'))
       <div class="alert alert-success">
           {{ session('status') }}
       </div>
     @endif
      <div class="input-field">
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
        <label>Full Name</label>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <div class="input-field">
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Email</label>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Password</label>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>
      <div class="input-field">
        <input type="password" name="password_confirmation" required>
        <label>Confirm Password</label>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
      </div>
      <button type="submit">Register</button>
      <div class="register">
        <p>Already registered? <a href="{{ route('login') }}">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html> 
