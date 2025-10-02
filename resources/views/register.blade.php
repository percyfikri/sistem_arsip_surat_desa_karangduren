<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #6289ff 0%, #b8c6ff 100%);
            min-height: 100vh;
            margin: 0;
        }
        .register-container {
            width: 400px;
            margin: 70px auto;
            padding: 36px 32px 28px 32px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px #6289ff33;
            position: relative;
        }
        .register-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 18px;
        }
        .register-logo img {
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
        input[type="text"], input[type="email"], input[type="password"] {
            width: 93%;
            padding: 10px 12px;
            margin-top: 7px;
            border: 1.5px solid #b8c6ff;
            border-radius: 6px;
            font-size: 1rem;
            background: #f8faff;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
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
        .error, ul.validation {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 0.98rem;
        }
        ul.validation {
            margin: 0 0 10px 0;
            padding-left: 18px;
            text-align: left;
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
    <div class="register-container">
        <div class="register-logo">
            <img src="{{ asset('img/logo-malang.png') }}" alt="Logo" />
        </div>
        <h2>Daftar Akun</h2>

        @if ($errors->any())
            <ul class="validation">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('register.attempt') }}">
            @csrf

            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="{{ old('username') }}" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required>

            <label for="prodi">Prodi</label>
            <input id="prodi" name="prodi" type="text" value="{{ old('prodi') }}" required>

            <label for="nim">NIM</label>
            <input id="nim" name="nim" type="text" value="{{ old('nim') }}" required>

            <button type="submit">Daftar</button>
        </form>

        <a class="link-btn" href="{{ route('login.form') }}">Sudah punya akun? Masuk</a>
    </div>
</body>
</html>