<?php
session_start();
include '../../../koneksi.php';
include 'OrmasModel.php';

$ormasModel = new OrmasModel($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $ormasModel->deleteOrmas($id);
    if ($result) {
        $_SESSION['message'] = "Data ormas berhasil dihapus.";

        header("Location: ../ormas.php");
    } else {
        header("Location: ../ormas.php");
    }
    exit();
}
?>
