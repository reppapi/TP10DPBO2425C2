<?php
require_once 'models/Mobil.php';
require_once 'models/Jenis.php'; 

// Class ini mengatur logika bisnis untuk entitas Mobil
// Memerlukan dua model karena ada relasi data ke Jenis Mobil
class MobilViewModel
{
    private $mobil;
    private $jenis;

    // Membuka koneksi ke model Mobil dan Jenis sekaligus
    public function __construct()
    {
        $this->mobil = new Mobil();
        $this->jenis = new Jenis();
    }

    // Mengambil data mobil beserta nama jenisnya untuk ditampilkan
    public function getMobilList()
    {
        return $this->mobil->getAll();
    }

    // Mengambil data mobil spesifik untuk form edit
    public function getMobilById($id)
    {
        return $this->mobil->getById($id);
    }

    // Fungsi khusus untuk Data Binding:
    // Menyediakan daftar jenis mobil untuk mengisi opsi dropdown (select option) di form input
    public function getJenisList()
    {
        return $this->jenis->getAll();
    }

    // Menyimpan data mobil baru yang diinputkan user
    public function addMobil($nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        return $this->mobil->create($nama_mobil, $no_plat, $harga_sewa, $id_jenis);
    }

    // Memperbarui data mobil yang sudah tersimpan
    public function updateMobil($id, $nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        return $this->mobil->update($id, $nama_mobil, $no_plat, $harga_sewa, $id_jenis);
    }

    // Menghapus data mobil yang dipilih
    public function deleteMobil($id)
    {
        return $this->mobil->delete($id);
    }
}