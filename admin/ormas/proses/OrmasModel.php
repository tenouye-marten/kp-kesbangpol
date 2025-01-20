<?php
class OrmasModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah ormas
    public function tambahOrmas($nm_organisasi, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat,$keterangan, $id_kategori) {
        $query = "INSERT INTO tbl_ormas (nm_organisasi, nm_ketua, nm_sekretaris, nm_bendahara, alamat, keterangan, id_kategori) 
                  VALUES (:nm_organisasi, :nm_ketua, :nm_sekretaris, :nm_bendahara, :alamat,:keterangan, :id_kategori)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nm_organisasi', $nm_organisasi);
        $stmt->bindParam(':nm_ketua', $nm_ketua);
        $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
        $stmt->bindParam(':nm_bendahara', $nm_bendahara);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id_kategori', $id_kategori);
        return $stmt->execute();
    }

    // Fungsi untuk mendapatkan semua ormas
    public function getAllOrmas() {
        $query = "SELECT tbl_ormas.*, tbl_kategori.kategori 
                  FROM tbl_ormas 
                  JOIN tbl_kategori ON tbl_ormas.id_kategori = tbl_kategori.id";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mendapatkan ormas berdasarkan ID
    public function getOrmasById($id) {
        $query = "SELECT * FROM tbl_ormas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengupdate ormas
    public function updateOrmas($id, $nm_organisasi, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat,$keterangan, $id_kategori) {
        $query = "UPDATE tbl_ormas SET nm_organisasi = :nm_organisasi, nm_ketua = :nm_ketua, 
                  nm_sekretaris = :nm_sekretaris, nm_bendahara = :nm_bendahara, alamat = :alamat, keterangan = :keterangan, 
                  id_kategori = :id_kategori WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nm_organisasi', $nm_organisasi);
        $stmt->bindParam(':nm_ketua', $nm_ketua);
        $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
        $stmt->bindParam(':nm_bendahara', $nm_bendahara);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id_kategori', $id_kategori);
        return $stmt->execute();
    }

    // Fungsi untuk menghapus ormas
    public function deleteOrmas($id) {
        $query = "DELETE FROM tbl_ormas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
