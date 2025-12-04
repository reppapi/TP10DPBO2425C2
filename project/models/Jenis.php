<?php
require_once "config/Database.php";

// Class untuk menangani interaksi database tabel Jenis (Kategori Mobil)
class Jenis
{
    private $conn;
    private $table = "jenis";

    // Membuka koneksi database saat class diinisialisasi
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil seluruh data jenis mobil yang tersedia
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mencari satu data jenis mobil spesifik berdasarkan ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambahkan data kategori baru ke database
    public function create($nama_jenis)
    {
        $query = "INSERT INTO " . $this->table . " (nama_jenis) VALUES (:nama_jenis)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_jenis', $nama_jenis);
        return $stmt->execute();
    }

    // Memperbarui nama jenis mobil yang sudah ada
    public function update($id, $nama_jenis)
    {
        $query = "UPDATE " . $this->table . " SET nama_jenis = :nama_jenis WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_jenis', $nama_jenis);
        return $stmt->execute();
    }

    // Menghapus data jenis mobil berdasarkan ID yang dipilih
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}