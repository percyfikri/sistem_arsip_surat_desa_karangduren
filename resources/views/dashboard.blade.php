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
            <div class="col-12 col-md-3 bg-light ">
                @include('component.sidebar')
            </div>
            <div class="col-12 col-md-9">
                <div class="w-100 mb-4" style="padding: 0.5rem; border-bottom:2px solid #eee;">
                    <div class="d-flex align-items-center justify-content-start" style="min-height:90px;">
                        <img src="{{ asset('img/logo-malang.png') }}" alt="Logo Kabupaten Malang" style="height:64px; width:auto; margin-right:18px;">
                        <h1 class="fw-bold mb-0" style="font-size:2rem; letter-spacing:0.5px; margin:0; padding:0;">
                            Sistem Arsip Surat Karangduren
                        </h1>
                    </div>
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
{{-- fafbfc --}}