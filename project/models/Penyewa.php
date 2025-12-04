<?php
require_once "config/Database.php";

// Class untuk mengelola data customer/penyewa
class Penyewa
{
    private $conn;
    private $table = "penyewa";

    // Inisialisasi koneksi ke database
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Menampilkan daftar semua penyewa yang terdaftar
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil detail data satu penyewa berdasarkan ID-nya
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',  $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mendaftarkan penyewa baru beserta kontaknya
    public function create($nama_penyewa, $kontak)
    {
        $query = "INSERT INTO " . $this->table . " (nama_penyewa, kontak) VALUES (:nama_penyewa, :kontak)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_penyewa', $nama_penyewa);
        $stmt->bindParam(':kontak', $kontak);
        return $stmt->execute();
    }

    // Mengupdate informasi penyewa (nama atau kontak)
    public function update($id, $nama_penyewa, $kontak)
    {
        $query = "UPDATE " . $this->table . " SET nama_penyewa = :nama_penyewa, kontak = :kontak WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_penyewa', $nama_penyewa);
        $stmt->bindParam(':kontak', $kontak);
        return $stmt->execute();
    }

    // Menghapus data penyewa dari sistem
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}