<?php
session_start();
include '../../../koneksi.php';
include 'UserController.php';

// Inisialisasi controller
$userController = new UserController($pdo);

// Cek jika ada ID yang diberikan untuk dihapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($userController->deleteUser($id)) {
        $_SESSION['message'] = "Data User berhasil dihapus.";
        header("Location: ../user.php");
    } else {
        echo "Terjadi kesalahan dalam menghapus data!";
    }
}
?>
