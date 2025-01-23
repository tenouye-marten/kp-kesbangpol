<?php
class OrmasModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah ormas
    public function tambahOrmas($nm_organisasi, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $keterangan, $id_kategori, $sk) {
        try {
            // Cek apakah id_kategori ada di tabel kategori
            $cekQuery = "SELECT COUNT(*) FROM tbl_kategori WHERE id = :id";
            $cekStmt = $this->pdo->prepare($cekQuery);
            $cekStmt->bindParam(':id', $id_kategori, PDO::PARAM_INT);
            $cekStmt->execute();
            $kategoriAda = $cekStmt->fetchColumn();
    
            if ($kategoriAda == 0) {
                throw new Exception("Error: ID kategori '$id_kategori' tidak ditemukan di tabel kategori.");
            }
    
            // Jika valid, masukkan data baru ke tabel ormas
            $query = "INSERT INTO tbl_ormas (nm_organisasi, nm_ketua, nm_sekretaris, nm_bendahara, alamat, keterangan, id_kategori, sk) 
                      VALUES (:nm_organisasi, :nm_ketua, :nm_sekretaris, :nm_bendahara, :alamat, :keterangan, :id_kategori, :sk)";
            $stmt = $this->pdo->prepare($query);
    
            $stmt->bindParam(':nm_organisasi', $nm_organisasi);
            $stmt->bindParam(':nm_ketua', $nm_ketua);
            $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
            $stmt->bindParam(':nm_bendahara', $nm_bendahara);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':keterangan', $keterangan);
            $stmt->bindParam(':id_kategori', $id_kategori, PDO::PARAM_INT);
            $stmt->bindParam(':sk', $sk);
    
            $stmt->execute();
            return "Data ormas berhasil ditambahkan!";
        } catch (PDOException $e) {
            // Tangani error database
            return "Database error: " . $e->getMessage();
        } catch (Exception $e) {
            // Tangani error umum lainnya
            return $e->getMessage();
        }
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
    // public function getOrmasById($id) {
    //     $query = "SELECT * FROM tbl_ormas WHERE id = :id";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    public function getOrmasById($id) {
        $query = "SELECT * FROM tbl_ormas WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Fungsi untuk mengupdate ormas
    public function updateOrmas($id, $nm_organisasi, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $keterangan, $id_kategori, $sk = null) {
        try {
            // Ambil file SK lama sebelum melakukan update
            $oldQuery = "SELECT sk FROM tbl_ormas WHERE id = :id";
            $oldStmt = $this->pdo->prepare($oldQuery);
            $oldStmt->bindParam(':id', $id);
            $oldStmt->execute();
            $oldFile = $oldStmt->fetchColumn();
    
            // Mulai query dasar
            $query = "UPDATE tbl_ormas SET nm_organisasi = :nm_organisasi, nm_ketua = :nm_ketua, 
                      nm_sekretaris = :nm_sekretaris, nm_bendahara = :nm_bendahara, alamat = :alamat, 
                      keterangan = :keterangan, id_kategori = :id_kategori";
    
            // Tambahkan update untuk file SK jika ada file baru
            if ($sk) {
                $query .= ", sk = :sk";
            }
            $query .= " WHERE id = :id";
    
            $stmt = $this->pdo->prepare($query);
    
            // Bind parameter utama
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nm_organisasi', $nm_organisasi);
            $stmt->bindParam(':nm_ketua', $nm_ketua);
            $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
            $stmt->bindParam(':nm_bendahara', $nm_bendahara);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':keterangan', $keterangan);
            $stmt->bindParam(':id_kategori', $id_kategori);
    
            // Bind file SK jika ada
            if ($sk) {
                $stmt->bindParam(':sk', $sk);
            }
    
            // Eksekusi query
            $success = $stmt->execute();
    
            // Hapus file lama jika SK baru diunggah dan update berhasil
            if ($sk && $success) {
                if ($oldFile && file_exists("../imgSk/" . $oldFile)) {
                    unlink("../imgSk/" . $oldFile);
                }
            }
    
            return $success;
        } catch (PDOException $e) {
            // Tangani error database
            return "Database error: " . $e->getMessage();
        } catch (Exception $e) {
            // Tangani error umum lainnya
            return $e->getMessage();
        }
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
