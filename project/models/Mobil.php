<?php
require_once "config/Database.php";

// Class untuk manajemen data produk mobil
class Mobil
{
    private $conn;
    private $table = "mobil";

    // Mempersiapkan koneksi database
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mengambil data mobil sekaligus menggabungkan (JOIN) dengan tabel jenis agar nama kategori muncul
    public function getAll()
    {
        // JOIN supaya muncul nama jenisnya
        $query = "SELECT mobil.*, jenis.nama_jenis FROM " . $this->table . " 
                  JOIN jenis ON mobil.id_jenis = jenis.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mencari data mobil spesifik untuk keperluan edit
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menyimpan data mobil baru lengkap dengan harga dan relasi ke tabel jenis
    public function create($nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        $query = "INSERT INTO " . $this->table . " (nama_mobil, no_plat, harga_sewa, id_jenis) VALUES (:nama_mobil, :no_plat, :harga_sewa, :id_jenis)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_mobil', $nama_mobil);
        $stmt->bindParam(':no_plat', $no_plat);
        $stmt->bindParam(':harga_sewa', $harga_sewa);
        $stmt->bindParam(':id_jenis', $id_jenis);
        return $stmt->execute();
    }

    // Memperbarui detail mobil yang sudah ada
    public function update($id, $nama_mobil, $no_plat, $harga_sewa, $id_jenis)
    {
        $query = "UPDATE " . $this->table . " SET nama_mobil = :nama_mobil, no_plat = :no_plat, harga_sewa = :harga_sewa, id_jenis = :id_jenis WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_mobil', $nama_mobil);
        $stmt->bindParam(':no_plat', $no_plat);
        $stmt->bindParam(':harga_sewa', $harga_sewa);
        $stmt->bindParam(':id_jenis', $id_jenis);
        return $stmt->execute();
    }

    // Menghapus unit mobil dari database
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}