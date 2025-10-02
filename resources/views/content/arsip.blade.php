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
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('admin.arsip.destroy', $letter->letter_id) }}')">Hapus</button>
                        <a href="{{ asset('storage/'.$letter->path) }}" class="btn btn-warning btn-sm" target="_blank">Unduh</a>
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="showLihatModal({{ json_encode(['nomor_surat' => $letter->nomor_surat, 'kategori' => $letter->category->name_category ?? '-', 'judul' => $letter->title, 'waktu' => $letter->created_at->format('Y-m-d H:i'), 'pdf_url' => asset('storage/'.$letter->path), 'edit_url' => route('admin.arsip.edit', $letter->letter_id)]) }})">Lihat &gt;&gt;</a>
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

    <!-- Modal Add Data -->
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 fw-bold" id="confirmDeleteLabel">Alert</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus arsip surat ini?</p>
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

<!-- Modal Lihat Arsip Surat -->
<div class="modal fade" id="lihatArsipModal" tabindex="-1" aria-labelledby="lihatArsipLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="lihatArsipLabel">Arsip Surat &gt;&gt; Lihat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div id="arsipDetail">
                    <div class="mb-3">
                        <div><b>Nomor:</b> <span id="lihat_nomor"></span></div>
                        <div><b>Kategori:</b> <span id="lihat_kategori"></span></div>
                        <div><b>Judul:</b> <span id="lihat_judul"></span></div>
                        <div><b>Waktu Unggah:</b> <span id="lihat_waktu"></span></div>
                    </div>
                    <div class="border p-2 mb-3" style="height:400px;">
                        <iframe id="lihat_pdf" src="" width="100%" height="100%" style="border:none;"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&lt;&lt; Kembali</button>
                <a id="lihat_unduh" href="#" class="btn btn-warning" target="_blank">Unduh</a>
                <a id="lihat_edit" href="#" class="btn btn-primary">Edit/Ganti File</a>
            </div>
        </div>
    </div>
</div>

<script>
function showLihatModal(letter) {
    // Isi data ke modal
    document.getElementById('lihat_nomor').textContent = letter.nomor_surat;
    document.getElementById('lihat_kategori').textContent = letter.kategori;
    document.getElementById('lihat_judul').textContent = letter.judul;
    document.getElementById('lihat_waktu').textContent = letter.waktu;
    document.getElementById('lihat_pdf').src = letter.pdf_url;
    document.getElementById('lihat_unduh').href = letter.pdf_url;
    document.getElementById('lihat_edit').href = letter.edit_url;

    var modal = new bootstrap.Modal(document.getElementById('lihatArsipModal'));
    modal.show();
}
</script>

{{-- Script ini untuk submit form arsip surat via AJAX agar modal tidak tertutup saat error--}}
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

// Script untuk set action form hapus sesuai surat yang dipilih
function confirmDelete(url) {
    const form = document.getElementById('deleteForm');
    form.action = url;
    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();
}
</script>
@endsection