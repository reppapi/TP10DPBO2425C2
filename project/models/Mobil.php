<?php
require_once "config/Database.php";

// Kelas Mobil menangani operasi CRUD untuk tabel mobil
class Mobil {
    private $conn;
    private $table = "mobil";

    // Konstruktor membuat koneksi ke database
    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Mengambil seluruh data mobil beserta jenisnya (relasi join)
    public function getAll() {
        $query = "SELECT mobil.*, jenis_mobil.nama AS jenis 
                  FROM mobil 
                  JOIN jenis_mobil ON mobil.jenis_id = jenis_mobil.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Menambahkan data mobil baru
    public function insert($nama, $plat, $jenis_id, $harga) {
        $query = "INSERT INTO " . $this->table . " (nama, plat, jenis_id, harga) 
                  VALUES (:nama, :plat, :jenis_id, :harga)";
        $stmt = $this->conn->prepare($query);

        // Binding parameter untuk data mobil
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':plat', $plat);
        $stmt->bindParam(':jenis_id', $jenis_id);
        $stmt->bindParam(':harga', $harga);

        return $stmt->execute();
    }

    // Mengambil satu data mobil berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Binding ID untuk pencarian
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Memperbarui data mobil berdasarkan ID
    public function update($id, $nama, $plat, $jenis_id, $harga) {
        $query = "UPDATE " . $this->table . " 
                  SET nama = :nama, plat = :plat, jenis_id = :jenis_id, harga = :harga 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding parameter untuk data yang diubah
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':plat', $plat);
        $stmt->bindParam(':jenis_id', $jenis_id);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Menghapus satu data mobil berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding ID untuk proses penghapusan
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
