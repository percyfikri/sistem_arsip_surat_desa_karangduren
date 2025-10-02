{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/content/category.blade.php --}}
@extends('dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-semibold">Kategori Surat</h2>
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
                    <th style="width:40px;">No</th>
                    <th class="text-center">ID Kategori</th>
                    <th class="text-center">Nama Kategori</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center" style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $i => $cat)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-center">{{ $cat->category_id }}</td>
                    <td>{{ $cat->name_category }}</td>
                    <td>{{ $cat->description }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('admin.category.destroy', $cat->category_id) }}')">Hapus</button>
                        <a href="javascript:void(0)" onclick="showEditModal({{ $cat }})" class="btn btn-primary btn-sm ms-2">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <button class="btn btn-success mt-2 fw-bold" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
        [+] Tambah Kategori Baru...
    </button>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0" style="background-color: #6289ff">
                    <h5 class="modal-title fw-bold" id="tambahKategoriLabel" style="color: white">Tambah Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>
                    <div class="mb-3 row">
                        <label for="id_kategori" class="col-sm-4 col-form-label fw-semibold">ID (Auto Increment)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="id_kategori" value="{{ $categories->last()?->category_id + 1 ?? 1 }}" disabled style="max-width:100px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name_category" class="col-sm-4 col-form-label fw-semibold">Nama Kategori</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="name_category" name="name_category" required style="max-width:300px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-4 col-form-label fw-semibold">Judul</label>
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

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editKategoriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0" style="background-color: #6289ff">
                    <h5 class="modal-title fw-bold" id="editKategoriLabel" style="color: white">Edit Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>
                    <div class="mb-3 row">
                        <label for="edit_id_kategori" class="col-sm-4 col-form-label fw-semibold">ID (Auto Increment)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="edit_id_kategori" disabled style="max-width:100px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_name_category" class="col-sm-4 col-form-label fw-semibold">Nama Kategori</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="edit_name_category" name="name_category" required style="max-width:300px;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_description" class="col-sm-4 col-form-label fw-semibold">Judul</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 fw-bold" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk membuka modal edit dan mengisi data
function showEditModal(cat) {
    document.getElementById('edit_id_kategori').value = cat.category_id;
    document.getElementById('edit_name_category').value = cat.name_category;
    document.getElementById('edit_description').value = cat.description;
    // Set action form ke route update
    document.getElementById('editKategoriForm').action = '/admin/category/' + cat.category_id;
    var modal = new bootstrap.Modal(document.getElementById('editKategoriModal'));
    modal.show();
}

// Fungsi untuk modal konfirmasi hapus
function confirmDelete(url) {
    document.getElementById('deleteForm').action = url;
    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();
}
</script>
@endsection