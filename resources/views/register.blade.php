<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { width: 400px; margin: 60px auto; padding: 28px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        h2 { text-align: center; margin-bottom: 20px; }
        label { display:block; margin-top:12px; }
        input[type="text"], input[type="email"], input[type="password"] { width:100%; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:4px; }
        button { width:100%; padding:10px; margin-top:16px; background:#28a745; color:#fff; border:none; border-radius:4px; font-size:16px; cursor:pointer; }
        button:hover { background:#1f8a37; }
        .error { color:#c00; margin-top:6px; font-size: 13px; }
        .link-btn { display:block; text-align:center; margin-top:12px; color:#007bff; text-decoration:none; }
        .link-btn:hover { text-decoration:underline; }
        ul.validation { margin:0; padding-left:18px; color:#c00; }
    </style>
</head>
<body>
    <div class="container">
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

            <label for="prodi">Prodi (opsional)</label>
            <input id="prodi" name="prodi" type="text" value="{{ old('prodi') }}">

            <label for="nim">NIM (opsional)</label>
            <input id="nim" name="nim" type="text" value="{{ old('nim') }}">

            <button type="submit">Daftar</button>
        </form>

        <a class="link-btn" href="{{ route('login.form') }}">Sudah punya akun? Masuk</a>
    </div>
</body>
</html>