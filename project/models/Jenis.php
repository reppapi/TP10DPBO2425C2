<?php
require_once "config/Database.php";

// Kelas Jenis bertanggung jawab menangani operasi CRUD untuk tabel jenis_mobil
class Jenis {
    private $conn;
    private $table = "jenis_mobil";

    // Konstruktor menerima instance koneksi database
    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Mengambil seluruh data jenis mobil dari tabel
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Menambahkan data jenis mobil baru
    public function insert($nama) {
        $query = "INSERT INTO " . $this->table . " (nama) VALUES (:nama)";
        $stmt = $this->conn->prepare($query);

        // Binding parameter nama jenis mobil
        $stmt->bindParam(':nama', $nama);

        return $stmt->execute();
    }

    // Mengambil satu data jenis mobil berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Binding parameter ID untuk pencarian
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Memperbarui data jenis mobil berdasarkan ID
    public function update($id, $nama) {
        $query = "UPDATE " . $this->table . " SET nama = :nama WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding parameter nama dan ID
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Menghapus data jenis mobil berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Binding parameter ID untuk proses penghapusan
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
