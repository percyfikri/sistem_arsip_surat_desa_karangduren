# Sistem Arsip Surat Desa Karangduren

Aplikasi web untuk mengelola arsip surat digital di lingkungan Karangduren. Sistem ini memudahkan pencatatan, pengarsipan, pencarian, dan pengelolaan surat masuk/keluar secara elektronik.

## Tujuan

- Mempermudah proses pengarsipan dan pencarian surat.
- Mengurangi penggunaan kertas dan ruang penyimpanan fisik.
- Menyediakan akses cepat dan aman terhadap dokumen surat.

## Fitur

- **Manajemen Surat:** Tambah, edit, hapus, dan lihat detail surat.
- **Kategori Surat:** Pengelompokan surat berdasarkan kategori.
- **Upload PDF:** Setiap surat dapat diunggah dalam format PDF.
- **Pencarian Surat:** Cari surat berdasarkan nomor, judul, atau kategori.
- **Manajemen User:** Registrasi, login, dan logout user.
- **Keamanan:** Autentikasi, otorisasi, dan proteksi CSRF.
- **Responsive Design:** Tampilan nyaman di desktop.

## Cara Menjalankan

1. **Clone repository**
   ```bash
   git clone <repo-url>
   cd arsip-surat

2. **Install dependency**
   ```bash
    composer install 
    npm install && npm run build

3. Copy file environment
    ```bash
    cp .env.example .env

4. Atur konfigurasi database di file .env.

5. Generate key
    ```bash
    php artisan key:generate

7. Migrasi dan seeder database
    ```bash
    php artisan migrate:fresh --seed

9. Jalankan server
    ```bash
    php artisan serve

11. Akses aplikasi Buka browser ke http://localhost:8000

## Screenshot
1. **Tampilan Login**
![Tampilan Login](image.png)
2. **Tampilan Arsip Surat**
![Tampilan Arsip Surat](image-1.png)
3. **Tampilan Kategori Surat**
![Tampilan Kategori Surat](image-2.png)
4. **Tampilan About**
![Tampilan About](image-3.png)
