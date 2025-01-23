<?php
class parpolModel {
    private $pdo;

    // Konstruktor menerima objek PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah data partai politik
    public function tambahData($nm_parpol, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $periode_kepengurusan, $sk) {
        // Query untuk menambah data
        $query = "INSERT INTO tbl_parpol (nm_parpol, nm_ketua, nm_sekretaris, nm_bendahara, alamat, periode_kepengurusan,sk) 
                  VALUES (:nm_parpol, :nm_ketua, :nm_sekretaris, :nm_bendahara, :alamat, :periode_kepengurusan, :sk)";
        
        // Persiapkan statement
        $stmt = $this->pdo->prepare($query);
        
        // Bind parameter ke query
        $stmt->bindParam(':nm_parpol', $nm_parpol);
        $stmt->bindParam(':nm_ketua', $nm_ketua);
        $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
        $stmt->bindParam(':nm_bendahara', $nm_bendahara);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':periode_kepengurusan', $periode_kepengurusan);
        $stmt->bindParam(':sk', $sk);
        
        // Eksekusi query
        $stmt->execute();
    }

    public function getParpolById($id) {
        $query = "SELECT * FROM tbl_parpol; WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    
    public function updateParpol($id, $nm_parpol, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $periode_kepengurusan, $sk = null) {
        try {
            // Ambil file SK lama sebelum melakukan update
            $oldQuery = "SELECT sk FROM tbl_parpol WHERE id = :id";
            $oldStmt = $this->pdo->prepare($oldQuery);
            $oldStmt->bindParam(':id', $id);
            $oldStmt->execute();
            $oldFile = $oldStmt->fetchColumn();
    
            // Mulai query dasar
            $query = "UPDATE tbl_parpol SET nm_parpol = :nm_parpol, nm_ketua = :nm_ketua, 
                      nm_sekretaris = :nm_sekretaris, nm_bendahara = :nm_bendahara, alamat = :alamat, 
                      periode_kepengurusan = :periode_kepengurusan";
    
  
            // Tambahkan update untuk file SK jika ada file baru
            if ($sk) {
                $query .= ", sk = :sk";
            }
            $query .= " WHERE id = :id";
    
            $stmt = $this->pdo->prepare($query);
    
            // Bind parameter utama
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nm_parpol', $nm_parpol);
            $stmt->bindParam(':nm_ketua', $nm_ketua);
            $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
            $stmt->bindParam(':nm_bendahara', $nm_bendahara);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':periode_kepengurusan', $periode_kepengurusan);
        
    
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



}
