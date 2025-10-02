<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .login-container { width: 350px; margin: 80px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        h2 { text-align: center; margin-bottom: 24px; }
        label { display:block; margin-top:12px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin-top: 6px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; margin-top: 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; text-align: center; margin-bottom: 10px; }
        .link-btn { display:block; text-align:center; margin-top:10px; color:#007bff; text-decoration:none; }
        .link-btn:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <label for="login">Email</label>
            <input type="text" id="login" name="login" placeholder="123@gmail.com" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="*****">

            <button type="submit">Masuk</button>
        </form>
        <a class="link-btn" href="{{ route('register.form') }}">Belum punya akun? Daftar</a>
    </div>
</body>
</html>