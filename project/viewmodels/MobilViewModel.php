<?php
require_once 'models/Mobil.php';
require_once 'models/Jenis.php';

// ViewModel untuk mengelola data Mobil dan menyediakan data pendukung untuk View
class MobilViewModel
{
    private $mobil; // Objek model Mobil
    private $jenis; // Objek model Jenis (untuk dropdown jenis mobil)

    public function __construct()
    {
        // Inisialisasi model Mobil dan Jenis
        $this->mobil = new Mobil();
        $this->jenis = new Jenis();
    }

    // Mengambil seluruh data mobil
    public function getMobilList()
    {
        return $this->mobil->getAll();
    }

    // Mengambil data mobil berdasarkan ID
    public function getMobilById($id)
    {
        return $this->mobil->getById($id);
    }

    // Mengambil daftar jenis mobil untuk kebutuhan dropdown di View
    public function getJenisList()
    {
        return $this->jenis->getAll();
    }

    // Menambah data mobil baru
    public function addMobil($nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        return $this->mobil->create($nama_mobil, $no_plat, $harga_sewa, $id_jenis);
    }

    // Memperbarui data mobil berdasarkan ID
    public function updateMobil($id, $nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        return $this->mobil->update($id, $nama_mobil, $no_plat, $harga_sewa, $id_jenis);
    }

    // Menghapus data mobil berdasarkan ID
    public function deleteMobil($id)
    {
        return $this->mobil->delete($id);
    }
}
