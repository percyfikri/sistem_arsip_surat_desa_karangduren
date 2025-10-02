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
                @for($i = 0; $i < 3; $i++)
                <tr>
                    <td colspan="4" style="height:40px;"></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
        [+] Tambah Kategori Baru...
    </button>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name_category" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name_category" name="name_category" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&lt;&lt; Kembali</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection