<?php
require_once 'models/Jenis.php';

// Class ini bertugas mengatur alur data untuk fitur Jenis Mobil (Kategori)
// Menjadi jembatan antara tampilan (View) dan database (Model)
class JenisViewModel
{
    private $jenis;

    // Menyiapkan model Jenis saat class dipanggil pertama kali
    public function __construct()
    {
        $this->jenis = new Jenis();
    }

    // Mengambil seluruh daftar jenis mobil untuk ditampilkan di tabel halaman utama
    public function getJenisList()
    {
        return $this->jenis->getAll();
    }

    // Mengambil data satu jenis mobil spesifik untuk ditampilkan di form edit
    public function getJenisById($id)
    {
        return $this->jenis->getById($id);
    }

    // Menerima input dari form dan memintanya untuk disimpan ke database
    public function addJenis($nama_jenis)
    {
        return $this->jenis->create($nama_jenis);
    }

    // Mengirimkan data perubahan yang diedit user ke model
    public function updateJenis($id, $nama_jenis)
    {
        return $this->jenis->update($id, $nama_jenis);
    }

    // Memproses permintaan penghapusan data jenis mobil
    public function deleteJenis($id)
    {
        return $this->jenis->delete($id);
    }
}