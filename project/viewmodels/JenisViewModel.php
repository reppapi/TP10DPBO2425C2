<?php
require_once 'models/Jenis.php';

// ViewModel untuk menghubungkan logika Jenis dengan bagian View
class JenisViewModel
{
    private $jenis; // Instansiasi model Jenis

    public function __construct()
    {
        // Membuat objek model Jenis untuk digunakan di seluruh metode
        $this->jenis = new Jenis();
    }

    // Mengambil daftar seluruh jenis mobil
    public function getJenisList()
    {
        return $this->jenis->getAll();
    }

    // Mengambil satu data jenis berdasarkan ID
    public function getJenisById($id)
    {
        return $this->jenis->getById($id);
    }

    // Menambahkan data jenis baru
    public function addJenis($nama_jenis)
    {
        return $this->jenis->create($nama_jenis);
    }

    // Memperbarui data jenis berdasarkan ID
    public function updateJenis($id, $nama_jenis)
    {
        return $this->jenis->update($id, $nama_jenis);
    }

    // Menghapus data jenis berdasarkan ID
    public function deleteJenis($id)
    {
        return $this->jenis->delete($id);
    }
}
