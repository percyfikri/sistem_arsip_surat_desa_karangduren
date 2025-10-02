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
                @foreach($letters as $letter)
                <tr>
                    <td>{{ $letter->nomor_surat }}</td>
                    <td>{{ $letter->category->name_category ?? '-' }}</td>
                    <td>{{ $letter->title }}</td>
                    <td>{{ $letter->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.arsip.destroy', $letter->letter_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                        <a href="{{ asset('storage/'.$letter->path) }}" class="btn btn-warning btn-sm" target="_blank">Unduh</a>
                        <a href="{{ asset('storage/'.$letter->path) }}" class="btn btn-primary btn-sm" target="_blank">Lihat &gt;&gt;</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-center" style="height:50px;"></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center" style="height:50px;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Tombol untuk memunculkan modal -->
    <button class="btn btn-outline-dark mt-2" data-bs-toggle="modal" data-bs-target="#arsipModal">
        Arsipkan Surat..
    </button>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="arsipModal" tabindex="-1" aria-labelledby="arsipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="arsipForm" action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="arsipModalLabel">Arsip Surat &gt;&gt; Unggah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br>
                            <b>Catatan:</b>
                            <ul>
                                <li>Gunakan file berformat PDF</li>
                            </ul>
                        </p>
                        <div class="mb-3 row">
                            <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                                @error('nomor_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="kategori" name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                            {{ $cat->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="judul" name="title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="file_surat" class="col-sm-3 col-form-label">File Surat (PDF)</label>
                            <div class="col-sm-9 d-flex flex-column">
                                <input type="file" class="form-control" id="file_surat" name="file_surat" accept="application/pdf" required>
                                <small class="text-danger mt-1">Ukuran file maksimal 5MB</small>
                                @error('file_surat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&lt;&lt; Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('arsipForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Reset error
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            if (response.ok) {
                // Sukses, reload halaman atau tutup modal dan refresh table
                location.reload();
            } else {
                const data = await response.json();
                if (data.errors) {
                    Object.keys(data.errors).forEach(function(key) {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            let feedback = input.parentElement.querySelector('.invalid-feedback');
                            if (!feedback) {
                                feedback = document.createElement('div');
                                feedback.className = 'invalid-feedback';
                                input.parentElement.appendChild(feedback);
                            }
                            feedback.innerHTML = data.errors[key][0];
                        }
                    });
                }
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    });
});
</script>
@endsection