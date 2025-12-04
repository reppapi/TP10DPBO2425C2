<?php
// Load semua model yang dipakai TransaksiViewModel
require_once 'models/Transaksi.php';
require_once 'models/Mobil.php';
require_once 'models/Penyewa.php';

class TransaksiViewModel
{
    private $transaksi;
    private $mobil;
    private $penyewa;

    public function __construct()
    {
        // Inisialisasi objek model
        $this->transaksi = new Transaksi();
        $this->mobil = new Mobil();
        $this->penyewa = new Penyewa();
    }

    // Ambil semua transaksi
    public function getTransaksiList()
    {
        return $this->transaksi->getAll();
    }

    // Ambil satu transaksi berdasarkan ID
    public function getTransaksiById($id)
    {
        return $this->transaksi->getById($id);
    }

    // Ambil semua mobil untuk dropdown
    public function getMobilList()
    {
        return $this->mobil->getAll();
    }

    // Ambil semua penyewa untuk dropdown
    public function getPenyewaList()
    {
        return $this->penyewa->getAll();
    }

    // Tambah transaksi baru
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

    // Update transaksi berdasarkan ID
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

    // Hapus transaksi
    public function deleteTransaksi($id)
    {
        return $this->transaksi->delete($id);
    }
}
