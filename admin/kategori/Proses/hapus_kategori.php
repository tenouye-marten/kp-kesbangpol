<?php
session_start();
// Termasuk koneksi dan model
include '../../../koneksi.php';
include '../KategoriModel.php';

$model = new KategoriModel($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = $model->deleteKategori($id);
    if ($result) {
        $_SESSION['message'] = "Data Kategori berhasil dihapus.";

        header("Location: ../kategori.php");

    } else {
  
        header("Location: ../kategori.php");
    }
    exit();
}
