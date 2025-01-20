<?php
// Mulai sesi untuk menangani pesan alert
session_start();
// Include file koneksi
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan id
    $query = "DELETE FROM tbl_parpol WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

        // Menyimpan pesan sukses ke sesi
        $_SESSION['message'] = "Data partai politik berhasil dihapus.";

    // Redirect ke halaman utama setelah dihapus
    header("Location: parpol.php?status=hapus_success");
    exit();
} else {
    // Jika tidak ada ID yang diterima
    echo "Data tidak ditemukan.";
    exit();
}
?>
