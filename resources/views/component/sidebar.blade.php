{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/sidebar/sidebar.blade.php --}}
<div class="sidebar" style="width:200px; background:#f5f5f5; padding:20px;">
    <h3>Menu</h3>
    <ul style="list-style:none; padding:0;">
        <li><a href="{{ route('admin.arsip') }}">Arsip</a></li>
        <li><a href="{{ route('admin.category.index') }}">Kategori Surat</a></li>
        <li><a href="{{ route('admin.about') }}">About</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Logout</button>
            </form>
        </li>
    </ul>
</div>