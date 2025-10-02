{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/content/about.blade.php --}}
@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-semibold mb-4">About</h2>
    <div class="d-flex align-items-start" style="gap: 32px;">
        <div>
            <div style="width:140px; height:140px; border:4px solid #222; border-radius:16px; display:flex; align-items:center; justify-content:center;">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="38" r="24" fill="#222"/>
                    <path d="M10 90 Q50 60 90 90" fill="#222"/>
                </svg>
            </div>
        </div>
        <div style="font-size:1.15rem;">
            <div>Aplikasi ini dibuat oleh :</div>
            <table style="margin-top:8px;">
                <tr>
                    <td>Nama</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td class="fw-semibold">{{ $user->username }}</td>
                </tr>
                <tr>
                    <td>Prodi</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td class="fw-semibold">{{ $user->prodi }}</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td class="fw-semibold">{{ $user->nim }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td class="fw-semibold">{{ $user->created_at->format('d F Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection