<?php
require_once 'models/Transaksi.php';
require_once 'models/Mobil.php';
require_once 'models/Penyewa.php';

// Class ViewModel paling kompleks yang menangani Transaksi Rental
// Menggabungkan logika dari 3 Model sekaligus (Transaksi, Mobil, Penyewa)
class TransaksiViewModel
{
    private $transaksi;
    private $mobil;
    private $penyewa;

    // Menginisialisasi semua model yang dibutuhkan untuk proses transaksi
    public function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->mobil = new Mobil();
        $this->penyewa = new Penyewa();
    }

    // Mengambil riwayat transaksi lengkap dengan nama mobil dan nama penyewa
    public function getTransaksiList()
    {
        return $this->transaksi->getAll();
    }

    // Mengambil detail satu transaksi untuk diedit
    public function getTransaksiById($id)
    {
        return $this->transaksi->getById($id);
    }

    // Data Binding 1: Menyediakan daftar mobil untuk dropdown di form transaksi
    public function getMobilList()
    {
        return $this->mobil->getAll();
    }

    // Data Binding 2: Menyediakan daftar penyewa untuk dropdown di form transaksi
    public function getPenyewaList()
    {
        return $this->penyewa->getAll();
    }

    // Memproses penyimpanan transaksi baru lengkap dengan status dan total bayar
    public function addTransaksi($id_mobil, $id_penyewa, $tanggal_pinjam, $lama_hari, $total_bayar, $status)
    {
        return $this->transaksi->create(
            $id_mobil,
            $id_penyewa,
            $tanggal_pinjam,
            $lama_hari,
            $total_bayar,
            $status
        );
    }

    // Memproses update data transaksi (misalnya pengembalian mobil/ganti status)
    public function updateTransaksi($id, $id_mobil, $id_penyewa, $tanggal_pinjam, $lama_hari, $total_bayar, $status)
    {
        return $this->transaksi->update(
            $id,
            $id_mobil,
            $id_penyewa,
            $tanggal_pinjam,
            $lama_hari,
            $total_bayar,
            $status
        );
    }

    // Menghapus data riwayat transaksi
    public function deleteTransaksi($id)
    {
        return $this->transaksi->delete($id);
    }
}