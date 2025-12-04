# TP10DPBO2425C2

# Janji

Saya **Repa Pitriani** dengan NIM **2402499** mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Sistem Manajemen Rental Mobil Berbasis Arsitektur MVVM

## Deskripsi Proyek

Sistem Manajemen Rental Mobil adalah aplikasi berbasis web yang dikembangkan menggunakan bahasa pemrograman PHP Native. Proyek ini dirancang untuk memenuhi tugas praktikum Desain dan Pemrograman Berbasis Objek (DPBO) dengan fokus utama pada implementasi pola arsitektur **Model-View-ViewModel (MVVM)**.

Aplikasi ini bertujuan untuk memisahkan logika bisnis (ViewModel), antarmuka pengguna (View), dan akses data (Model) guna menciptakan kode yang lebih terstruktur, modular, dan mudah dipelihara. Sistem ini menangani proses operasional penyewaan mobil, mulai dari pendataan jenis mobil, armada mobil, data penyewa, hingga pencatatan transaksi penyewaan.

## Arsitektur Aplikasi (MVVM)

Aplikasi ini menerapkan pola arsitektur MVVM dengan pembagian tanggung jawab sebagai berikut:

1.  **Model**:

      * Bertanggung jawab penuh atas representasi data dan logika database.
      * Berisi kelas-kelas yang merepresentasikan tabel dalam database (Jenis, Mobil, Penyewa, Transaksi).
      * Menangani operasi *Create, Read, Update, Delete* (CRUD) secara langsung melalui eksekusi query SQL menggunakan PDO.
      * Tidak memiliki ketergantungan atau pengetahuan mengenai antarmuka pengguna (UI).

2.  **View**:

      * Bertanggung jawab untuk menampilkan data kepada pengguna dan menangkap interaksi pengguna.
      * Terdiri dari file-file HTML/PHP yang berada di dalam folder `views/`.
      * Bersifat pasif dan hanya menerima data yang telah diproses oleh ViewModel untuk ditampilkan.
      * Tidak mengandung logika bisnis yang kompleks.

3.  **ViewModel**:

      * Bertindak sebagai perantara (mediator) antara Model dan View.
      * Menangani logika bisnis aplikasi dan transformasi data.
      * **Data Binding**: ViewModel memfasilitasi mekanisme data binding, contohnya saat mengambil daftar "Jenis Mobil" dari Model untuk ditampilkan sebagai pilihan *dropdown* pada formulir tambah "Mobil".
      * Menerima permintaan dari `index.php` (Router), memprosesnya menggunakan Model, dan menyediakan data yang siap ditampilkan oleh View.

## Fitur Aplikasi

Aplikasi ini memiliki fitur CRUD lengkap untuk empat entitas data yang saling berelasi:

1.  **Manajemen Jenis Mobil (Kategori)**

      * Menambah, mengubah, menghapus, dan menampilkan daftar kategori mobil (contoh: SUV, MPV, Sedan).

2.  **Manajemen Data Penyewa**

      * Mengelola informasi pelanggan yang mencakup nama lengkap dan informasi kontak.

3.  **Manajemen Armada Mobil**

      * Mengelola data mobil yang disewakan, termasuk nama mobil, nomor polisi, dan harga sewa per hari.
      * **Relasi**: Setiap mobil terhubung dengan satu "Jenis Mobil" (Foreign Key).

4.  **Manajemen Transaksi Penyewaan**

      * Mencatat transaksi penyewaan mobil.
      * **Relasi Ganda**: Transaksi menghubungkan entitas "Mobil" dan "Penyewa".
      * Menghitung total biaya sewa secara manual atau otomatis berdasarkan harga sewa mobil dikalikan lama peminjaman.
      * Pengelolaan status peminjaman ("Dipinjam" atau "Selesai").

## Struktur Database

Sistem ini menggunakan database MySQL bernama `rental_mobil` dengan skema sebagai berikut:

1.  **Tabel `jenis`**

      * `id` (Primary Key, Auto Increment)
      * `nama_jenis` (Varchar)

2.  **Tabel `mobil`**

      * `id` (Primary Key, Auto Increment)
      * `nama_mobil` (Varchar)
      * `no_plat` (Varchar)
      * `harga_sewa` (Decimal)
      * `id_jenis` (Foreign Key merujuk ke tabel `jenis`)

3.  **Tabel `penyewa`**

      * `id` (Primary Key, Auto Increment)
      * `nama_penyewa` (Varchar)
      * `kontak` (Varchar)

4.  **Tabel `transaksi`**

      * `id` (Primary Key, Auto Increment)
      * `id_mobil` (Foreign Key merujuk ke tabel `mobil`)
      * `id_penyewa` (Foreign Key merujuk ke tabel `penyewa`)
      * `tanggal_pinjam` (Date)
      * `lama_hari` (Int)
      * `total_bayar` (Decimal)
      * `status` (Enum: 'Dipinjam', 'Selesai')

Terdapat relasi *One-to-Many* antara Jenis dan Mobil, serta relasi *Many-to-Many* yang diimplementasikan pada tabel Transaksi (menghubungkan Mobil dan Penyewa).

## Struktur Direktori Proyek

Susunan folder dan file dalam proyek ini adalah sebagai berikut:

```
/project
├── config/
│   └── Database.php          # Konfigurasi koneksi database (PDO)
├── database/
│   └── rental_mobil.sql      # File import database MySQL
├── models/                   # Lapisan Data Access
│   ├── Jenis.php
│   ├── Mobil.php
│   ├── Penyewa.php
│   └── Transaksi.php
├── viewmodels/               # Lapisan Logika Bisnis
│   ├── JenisViewModel.php
│   ├── MobilViewModel.php
│   ├── PenyewaViewModel.php
│   └── TransaksiViewModel.php
├── views/                    # Lapisan Antarmuka Pengguna
│   ├── template/
│   │   ├── header.php        # Template navigasi atas
│   │   └── footer.php        # Template bagian bawah
│   ├── jenis_list.php
│   ├── jenis_form.php
│   ├── mobil_list.php
│   ├── mobil_form.php
│   ├── penyewa_list.php
│   ├── penyewa_form.php
│   ├── transaksi_list.php
│   └── transaksi_form.php
└── index.php                 # Entry Point & Routing System
```

## Dokumentasi

Klik thumbnail di bawah untuk menonton demo program:  

[![Demo Program](https://img.youtube.com/vi/2lXwqahURY0/0.jpg)](https://youtu.be/2lXwqahURY0)
