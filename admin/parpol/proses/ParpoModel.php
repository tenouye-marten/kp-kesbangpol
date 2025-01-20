<?php
class ParpolModel {
    private $pdo;

    // Konstruktor menerima objek PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah data partai politik
    public function tambahData($nm_parpol, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $periode_kepengurusan) {
        // Query untuk menambah data
        $query = "INSERT INTO tbl_parpol (nm_parpol, nm_ketua, nm_sekretaris, nm_bendahara, alamat, periode_kepengurusan) 
                  VALUES (:nm_parpol, :nm_ketua, :nm_sekretaris, :nm_bendahara, :alamat, :periode_kepengurusan)";
        
        // Persiapkan statement
        $stmt = $this->pdo->prepare($query);
        
        // Bind parameter ke query
        $stmt->bindParam(':nm_parpol', $nm_parpol);
        $stmt->bindParam(':nm_ketua', $nm_ketua);
        $stmt->bindParam(':nm_sekretaris', $nm_sekretaris);
        $stmt->bindParam(':nm_bendahara', $nm_bendahara);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':periode_kepengurusan', $periode_kepengurusan);
        
        // Eksekusi query
        return $stmt->execute();
    }
}
