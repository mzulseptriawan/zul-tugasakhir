# Backend Android Tugas Akhir Zulfikar

## Deskripsi Proyek
Proyek ini adalah implementasi dari **Metode LBS (Location Based Service)** pada aplikasi absensi berbasis Android. Aplikasi ini dirancang untuk melakukan pendeteksian lokasi pengguna dan melakukan pencatatan absensi secara otomatis berdasarkan lokasi yang terdeteksi. Studi kasus dilakukan di **Komite Ekonomi Kreatif dan Inovasi Kota Sukabumi**.

## Fitur Utama
- **Pencatatan Absensi Otomatis Berdasarkan Lokasi**
- **Deteksi Fake GPS dan Perangkat Root**
- **Notifikasi Absensi Real-time**
- **API REST untuk Integrasi dengan Aplikasi Android**

## Teknologi yang Digunakan
- **Laravel**: Sebagai backend untuk mengelola data absensi dan pengguna.
- **MySQL**: Basis data yang digunakan untuk menyimpan informasi absensi dan pengguna.
- **JWT Authentication**: Untuk keamanan API dan otentikasi pengguna.
- **LBS (Location Based Service)**: Untuk mendeteksi lokasi pengguna dalam proses absensi.

## Instalasi
1. Clone repository ini:
    ```bash
    git clone https://github.com/mzulseptriawan/zul-tugasakhir.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd nama-folder
    ```
3. Install dependency menggunakan Composer:
    ```bash
    composer install
    ```
4. Copy file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
5. Generate app key:
    ```bash
    php artisan key:generate
    ```
6. Set konfigurasi database di file `.env`.

7. Jalankan migration dan seeding:
    ```bash
    php artisan migrate --seed
    ```

8. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

## API Dokumentasi
Dokumentasi API tersedia menggunakan **Postman** atau alat serupa. Endpoint utama termasuk:
- **POST /api/login**: Untuk otentikasi pengguna.
- **GET /api/absensi**: Untuk mendapatkan data absensi.
- **POST /api/absensi**: Untuk mencatat absensi baru.

## Kontribusi
Kontribusi sangat terbuka! Untuk berkontribusi:
1. Fork repository ini.
2. Buat branch fitur Anda (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buat pull request.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

> **Dibuat oleh Zulfikar sebagai bagian dari Tugas Akhir di Komite Ekonomi Kreatif dan Inovasi Kota Sukabumi**
