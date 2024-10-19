# Deskripsi Blog

Selamat datang di repositori blog ini! Proyek ini adalah platform blog yang sedang dalam tahap pengembangan. Saya bertujuan untuk menciptakan ruang yang nyaman bagi para penulis dan pembaca untuk berbagi dan menemukan konten yang menarik.

## Fitur yang Direncanakan
- **Postingan Blog:** Pengguna dapat membuat, mengedit, dan menghapus postingan.
- **Kategorisasi:** Konten dapat dikelompokkan berdasarkan kategori untuk memudahkan pencarian.
- **Komentar:** Pembaca dapat memberikan umpan balik dan berdiskusi di bawah setiap postingan.
- **Responsif:** Desain yang dapat diakses dari berbagai perangkat.


## Tanda Proyek Selesai
Blog ini akan dianggap selesai ketika semua fitur utama telah diimplementasikan, pengujian telah dilakukan, dan tidak ada bug kritis yang tersisa. Anda dapat mengetahui bahwa blog telah selesai dengan:
- Semua fitur yang direncanakan telah terintegrasi dan berfungsi dengan baik.
- Dokumentasi lengkap tersedia untuk pengguna dan pengembang.
- Uji coba pengguna menunjukkan umpan balik positif.
- Blog siap untuk diluncurkan ke publik.

## Kontribusi
Walaupun saya mengembangkan proyek ini sendiri, saya sangat terbuka untuk masukan dan saran. Jika Anda memiliki ide atau rekomendasi, jangan ragu untuk menghubungi saya!

## Instalasi dan Pengaturan

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1. **Clone Repositori**
   ```bash
   git clone https://github.com/FruHafizd/Blog.git
   cd Blog
   ```

2. **Instal Dependensi PHP**
   Jalankan perintah berikut untuk menginstal dependensi yang diperlukan menggunakan Composer:
   ```bash
   composer install
   ```

3. **Jalankan Seeder**
   Setelah instalasi selesai, Anda perlu menjalankan seeder untuk mengisi database dengan data awal:
   ```bash
   php artisan migrate --seed
   ```

4. **Buat Link Storage**
   Jalankan perintah berikut untuk membuat link simbolis ke folder storage:
   ```bash
   php artisan storage:link
   ```

5. **Instal Dependensi JavaScript**
   Instal dependensi npm yang diperlukan untuk proyek:
   ```bash
   npm install
   ```

6. **Jalankan Server**
   Setelah semua instalasi selesai, Anda dapat menjalankan server lokal dengan perintah:
   ```bash
   php artisan serve
   ```
   
7. **Jalankan Server**
   Setelah semua instalasi selesai, Anda dapat menjalankan server lokal dengan perintah:
   ```bash
   npm run dev
   ```

8. **Akses Aplikasi**
   Buka browser Anda dan akses aplikasi di `http://localhost:8000`.

Terima kasih telah mengunjungi repositori ini! Saya berharap dapat segera meluncurkan blog yang bermanfaat bagi semua.
