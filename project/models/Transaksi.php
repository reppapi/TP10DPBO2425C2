<?php
require_once "config/Database.php";

// Kelas Transaksi menangani operasi CRUD serta logika transaksi penyewaan mobil
class Transaksi {
    private $conn;
    private $table = "transaksi";

    // Konstruktor membangun koneksi ke database
    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Mengambil seluruh data transaksi beserta relasinya (mobil dan penyewa)
    public function getAll() {
        $query = "SELECT transaksi.*, mobil.nama AS mobil, penyewa.nama AS penyewa 
                  FROM transaksi 
                  JOIN mobil ON transaksi.mobil_id = mobil.id 
                  JOIN penyewa ON transaksi.penyewa_id = penyewa.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Menambahkan transaksi baru
    public function insert($mobil_id, $penyewa_id, $tanggal, $lama, $total_harga) {
        $query = "INSERT INTO " . $this->table . " 
                  (mobil_id, penyewa_id, tanggal, lama, total_harga) 
                  VALUES (:mobil_id, :penyewa_id, :tanggal, :lama, :total_harga)";
        $stmt = $this->conn->prepare($query);

        // Binding parameter transaksi
        $stmt->bindParam(':mobil_id', $mobil_id);
        $stmt->bindParam(':penyewa_id', $penyewa_id);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':lama', $lama);
        $stmt->bindParam(':total_harga', $total_harga);

        return $stmt->execute();
    }

    // Mengambil satu transaksi berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Binding ID transaksi
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Memperbarui data transaksi
    public function update($id, $mobil_id, $penyewa_id, $tanggal, $lama, $total_harga) {
        $query = "UPDATE " . $this->table . " 
                  SET mobil_id = :mobil_id, penyewa_id = :penyewa_id, tanggal = :tanggal, 
                      lama = :lama, total_harga = :total_harga 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Binding parameter untuk data yang diperbarui
        $stmt->bindParam(':mobil_id', $mobil_id);
        $stmt->bindParam(':penyewa_id', $penyewa_id);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':lama', $lama);
        $stmt->bindParam(':total_harga', $total_harga);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Menghapus data transaksi berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding ID untuk penghapusan
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
