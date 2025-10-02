{{-- filepath: /d:/Semester 8 (Skripsi)/LSP/Project/arsip-surat/resources/views/sidebar/sidebar.blade.php --}}
<div class="sidebar d-flex flex-column align-items-start" style="height:100vh; border-right:2px solid #222; background:#fff; padding:24px 0 0 0;">
    <div class="w-100 px-4 mb-2">
        <span style="font-weight:700; font-size:1.15rem;">Menu</span>
        <hr class="my-2" style="border-top:2px solid #222; opacity:1;">
    </div>
    <ul class="nav flex-column w-100" style="gap:6px;">
        <li class="nav-item">
            <a href="{{ route('admin.arsip') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.arsip') ? 'fw-bold text-dark' : 'text-secondary' }}" style="font-size:1.08rem;">
                <span class="ms-1 me-2" style="font-size:1.2rem;">&#9733;</span> Arsip
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.category.index') ? 'fw-bold text-dark' : 'text-secondary' }}" style="font-size:1.08rem;">
                <span class="me-1" style="font-size:1.2rem;">&#128196;</span> Kategori Surat
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.about') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.about') ? 'fw-bold text-dark' : 'text-secondary' }}" style="font-size:1.08rem;">
                <span class="me-2" style="font-size:1.2rem;">&#8505;</span> About
            </a>
        </li>
        <li class="nav-item mt-4 px-4 w-100">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </li>
    </ul>
</div>