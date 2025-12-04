<?php
require_once "config/Database.php";

// Class utama untuk mencatat transaksi penyewaan
class Transaksi
{
    private $conn;
    private $table = "transaksi";

    // Setup koneksi database
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil data transaksi lengkap dengan detail Mobil dan Penyewa menggunakan JOIN
    public function getAll()
    {
        $query = "SELECT t.*, m.nama_mobil, p.nama_penyewa 
                  FROM " . $this->table . " t
                  JOIN mobil m ON t.id_mobil = m.id
                  JOIN penyewa p ON t.id_penyewa = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu data transaksi berdasarkan ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',  $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mencatat transaksi baru beserta status dan total biayanya
    public function create($id_mobil, $id_penyewa, $tanggal_pinjam, $lama_hari, $total_bayar, $status)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (id_mobil, id_penyewa, tanggal_pinjam, lama_hari, total_bayar, status) 
                  VALUES (:id_mobil, :id_penyewa, :tanggal_pinjam, :lama_hari, :total_bayar, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_mobil', $id_mobil);
        $stmt->bindParam(':id_penyewa', $id_penyewa);
        $stmt->bindParam(':tanggal_pinjam', $tanggal_pinjam);
        $stmt->bindParam(':lama_hari', $lama_hari);
        $stmt->bindParam(':total_bayar', $total_bayar);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Mengupdate data transaksi, termasuk perubahan status sewa
    public function update($id, $id_mobil, $id_penyewa, $tanggal_pinjam, $lama_hari, $total_bayar, $status)
    {
        $query = "UPDATE " . $this->table . " 
                  SET id_mobil = :id_mobil, id_penyewa = :id_penyewa, 
                      tanggal_pinjam = :tanggal_pinjam, lama_hari = :lama_hari, 
                      total_bayar = :total_bayar, status = :status 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_mobil', $id_mobil);
        $stmt->bindParam(':id_penyewa', $id_penyewa);
        $stmt->bindParam(':tanggal_pinjam', $tanggal_pinjam);
        $stmt->bindParam(':lama_hari', $lama_hari);
        $stmt->bindParam(':total_bayar', $total_bayar);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Menghapus riwayat transaksi dari sistem
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}