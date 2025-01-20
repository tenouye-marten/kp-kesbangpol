<?php
class KategoriModel {
    private $pdo;

    // Konstruktor menerima objek PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah kategori
    public function tambahKategori($kategori) {
        $query = "INSERT INTO tbl_kategori (Kategori) VALUES (:kategori)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':kategori', $kategori);
        return $stmt->execute();
    }

    // Fungsi untuk mendapatkan semua kategori
    public function getAllKategori() {
        $query = "SELECT * FROM tbl_kategori";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mendapatkan kategori berdasarkan ID
    public function getKategoriById($id) {
        $query = "SELECT * FROM tbl_kategori WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengupdate kategori
    public function updateKategori($id, $kategori) {
        $query = "UPDATE tbl_kategori SET Kategori = :kategori WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kategori', $kategori);
        return $stmt->execute();
    }

    // Fungsi untuk menghapus kategori
    public function deleteKategori($id) {
        $query = "DELETE FROM tbl_kategori WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
