<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #6289ff 0%, #b8c6ff 100%);
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 370px;
            margin: 80px auto;
            padding: 36px 32px 28px 32px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px #6289ff33;
            position: relative;
        }
        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 18px;
        }
        .login-logo img {
            height: 56px;
            width: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 18px;
            font-weight: 700;
            color: #2d3a6b;
            letter-spacing: 1px;
        }
        label {
            display: block;
            margin-top: 16px;
            font-weight: 500;
            color: #2d3a6b;
        }
        input[type="text"], input[type="password"] {
            width: 92%;
            padding: 10px 12px;
            margin-top: 7px;
            border: 1.5px solid #b8c6ff;
            border-radius: 6px;
            font-size: 1rem;
            background: #f8faff;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #6289ff;
            outline: none;
        }
        button {
            width: 100%;
            padding: 11px;
            margin-top: 22px;
            background: linear-gradient(90deg, #6289ff 60%, #b8c6ff 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1.08rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px #b8c6ff44;
            transition: background 0.2s;
        }
        button:hover {
            background: linear-gradient(90deg, #4a6edb 60%, #a0b3e7 100%);
        }
        .error {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 10px;
            font-weight: 500;
        }
        .link-btn {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #6289ff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .link-btn:hover {
            color: #2d3a6b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="{{ asset('img/logo-malang.png') }}" alt="Logo" />
        </div>
        <h2>Login Sistem Arsip Surat</h2>
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