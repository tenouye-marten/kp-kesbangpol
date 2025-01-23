<?php
session_start();
include '../../../koneksi.php';
include 'OrmasModel.php';

$ormasModel = new OrmasModel($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil informasi data yang akan dihapus
    $ormasData = $ormasModel->getOrmasById($id);
    
    if ($ormasData) {
        // Path file gambar
        $filePath = '../imgSk/' . $ormasData['sk'];

        // Hapus data dari database
        $result = $ormasModel->deleteOrmas($id);

        if ($result) {
            // Hapus file gambar jika data berhasil dihapus
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $_SESSION['message'] = "Data ormas berhasil dihapus.";
        } else {
            $_SESSION['message'] = "Data ormas gagal dihapus.";
        }
    } else {
        $_SESSION['message'] = "Data ormas tidak ditemukan.";
    }

    header("Location: ../ormas.php");
    exit();
}
?>
