<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arsip Surat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-12 col-md-3 bg-light p-4">
                @include('component.sidebar')
            </div>
            <div class="col-12 col-md-9 p-5">
                <div class="text-center mb-4">
                    <h1>Arsip Surat Desa Karangduren</h1>
                </div>
                {{-- Konten utama dashboard di sini --}}
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>