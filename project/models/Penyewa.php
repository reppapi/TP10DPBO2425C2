<?php
require_once "config/Database.php";

// Kelas Penyewa menangani operasi CRUD untuk tabel penyewa
class Penyewa {
    private $conn;
    private $table = "penyewa";

    // Konstruktor membuat koneksi database
    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Mengambil seluruh data penyewa
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Menambahkan data penyewa baru
    public function insert($nama, $no_ktp, $alamat, $telepon) {
        $query = "INSERT INTO " . $this->table . " (nama, no_ktp, alamat, telepon) 
                  VALUES (:nama, :no_ktp, :alamat, :telepon)";
        $stmt = $this->conn->prepare($query);

        // Binding parameter untuk data penyewa
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':no_ktp', $no_ktp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telepon', $telepon);

        return $stmt->execute();
    }

    // Mengambil satu data penyewa berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Binding ID untuk pencarian
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Memperbarui data penyewa
    public function update($id, $nama, $no_ktp, $alamat, $telepon) {
        $query = "UPDATE " . $this->table . " 
                  SET nama = :nama, no_ktp = :no_ktp, alamat = :alamat, telepon = :telepon 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding parameter untuk data yang diperbarui
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':no_ktp', $no_ktp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telepon', $telepon);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Menghapus data penyewa berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding ID untuk penghapusan
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
