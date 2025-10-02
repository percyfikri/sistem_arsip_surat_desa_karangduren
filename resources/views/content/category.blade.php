{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/content/category.blade.php --}}
@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold">Kategori Surat</h2>
    <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.<br>
        Klik <b>"Tambah"</b> pada kolom aksi untuk menambahkan kategori baru.
    </p>
    <form class="d-flex mb-3" role="search" method="GET" action="{{ route('admin.category.index') }}">
        <label for="search" class="me-2 align-self-center">Cari kategori:</label>
        <input class="form-control me-2" type="search" id="search" name="search" placeholder="search" aria-label="Search" style="max-width:350px;">
        <button class="btn btn-dark" type="submit">Cari!</button>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>ID Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->category_id }}</td>
                    <td>{{ $cat->name_category }}</td>
                    <td>{{ $cat->description }}</td>
                    <td>
                        <form action="{{ route('admin.category.destroy', $cat->category_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <a href="{{ route('admin.category.edit', $cat->category_id) }}" class="btn btn-primary btn-sm ms-2">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
        [+] Tambah Kategori Baru...
    </button>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="tambahKategoriLabel">Kategori Surat &gt;&gt; Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>
                    <div class="mb-3 row">
                        <label for="id_kategori" class="col-sm-4 col-form-label">ID (Auto Increment)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="id_kategori" value="{{ $categories->last()?->category_id + 1 ?? 1 }}" disabled style="max-width:100px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name_category" class="col-sm-4 col-form-label">Nama Kategori</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="name_category" name="name_category" required style="max-width:300px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-4 col-form-label">Judul</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&lt;&lt; Kembali</button>
                    <button type="submit" class="btn btn-success ms-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection