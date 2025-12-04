<?php
require_once 'models/Penyewa.php';

// Class ini berfungsi sebagai pengelola logika untuk data Penyewa (Customer)
class PenyewaViewModel
{
    private $penyewa;

    // Menginisialisasi model Penyewa agar siap digunakan
    public function __construct()
    {
        $this->penyewa = new Penyewa();
    }

    // Menyediakan daftar lengkap penyewa untuk view
    public function getPenyewaList()
    {
        return $this->penyewa->getAll();
    }

    // Mengambil detail data penyewa tertentu berdasarkan ID untuk keperluan edit
    public function getPenyewaById($id)
    {
        return $this->penyewa->getById($id);
    }

    // Menangani logika penambahan data penyewa baru
    public function addPenyewa($nama_penyewa, $kontak)
    {
        return $this->penyewa->create($nama_penyewa, $kontak);
    }

    // Menangani proses update data penyewa yang sudah ada
    public function updatePenyewa($id, $nama_penyewa, $kontak)
    {
        return $this->penyewa->update($id, $nama_penyewa, $kontak);
    }

    // Menghapus data penyewa dari sistem melalui model
    public function deletePenyewa($id)
    {
        return $this->penyewa->delete($id);
    }
}