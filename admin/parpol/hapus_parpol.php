<?php
// Mulai sesi untuk menangani pesan alert
session_start();

// Include file koneksi
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data untuk mendapatkan informasi file gambar
    $query = "SELECT sk FROM tbl_parpol WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        // Path file gambar
        $filePath = './imgSk/' . $data['sk'];

        // Hapus file gambar jika ada
        if (file_exists($filePath)) {
            unlink($filePath);  // Menghapus file
        }

        // Hapus data dari database
        $deleteQuery = "DELETE FROM tbl_parpol WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $deleteStmt->execute();

        // Menyimpan pesan sukses ke sesi
        $_SESSION['message'] = "Data partai politik  berhasil dihapus.";

        // Redirect ke halaman utama setelah dihapus
        header("Location: parpol.php?status=hapus_success");
        exit();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    // Jika tidak ada ID yang diterima
    echo "Data tidak ditemukan.";
    exit();
}
?>
