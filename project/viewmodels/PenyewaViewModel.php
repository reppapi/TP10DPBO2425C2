<?php
require_once 'models/Penyewa.php';

// ViewModel untuk menangani data penyewa dan interaksi dengan model
class PenyewaViewModel
{
    private $penyewa; // Objek model Penyewa

    public function __construct()
    {
        // Inisialisasi model Penyewa
        $this->penyewa = new Penyewa();
    }

    // Mengambil seluruh data penyewa
    public function getPenyewaList()
    {
        return $this->penyewa->getAll();
    }

    // Mengambil satu data penyewa berdasarkan ID
    public function getPenyewaById($id)
    {
        return $this->penyewa->getById($id);
    }

    // Menambah data penyewa baru
    public function addPenyewa($nama_penyewa, $kontak)
    {
        return $this->penyewa->create($nama_penyewa, $kontak);
    }

    // Memperbarui data penyewa berdasarkan ID
    public function updatePenyewa($id, $nama_penyewa, $kontak)
    {
        return $this->penyewa->update($id, $nama_penyewa, $kontak);
    }

    // Menghapus data penyewa berdasarkan ID
    public function deletePenyewa($id)
    {
        return $this->penyewa->delete($id);
    }
}
