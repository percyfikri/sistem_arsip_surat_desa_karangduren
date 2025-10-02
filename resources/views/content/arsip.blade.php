{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/content/arsip.blade.php --}}
@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold">Arsip Surat</h2>
    <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
        Klik <b>"Lihat"</b> pada kolom aksi untuk menampilkan surat.
    </p>
    <form class="d-flex mb-3" role="search">
        <label for="search" class="me-2 align-self-center">Cari surat:</label>
        <input class="form-control me-2" type="search" id="search" name="search" placeholder="search" aria-label="Search" style="max-width:350px;">
        <button class="btn btn-outline-dark" type="submit">Cari!</button>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>Nomor Surat</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Waktu Pengarsipan</th>
                    <th style="width:220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2022/PD3/TU/001</td>
                    <td>Pengumuman</td>
                    <td>Nota Dinas WFH</td>
                    <td>2023-06-21 17:23</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                        <button class="btn btn-warning btn-sm">Unduh</button>
                        <button class="btn btn-primary btn-sm">Lihat &gt;&gt;</button>
                    </td>
                </tr>
                <tr>
                    <td>2022/PD2/TU/022</td>
                    <td>Undangan</td>
                    <td>Undangan Halal Bi Halal</td>
                    <td>2023-04-21 18:23</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                        <button class="btn btn-warning btn-sm">Unduh</button>
                        <button class="btn btn-primary btn-sm">Lihat &gt;&gt;</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center" style="height:50px;"></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center" style="height:50px;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="btn btn-outline-dark mt-2">Arsipkan Surat..</button>
</div>
@endsection