<?php
// Koneksi ke database
$pdo = new PDO("mysql:host=localhost;dbname=kesbangpol", "root", "");

// Query untuk mengambil semua kategori
$query = "SELECT id, kategori FROM tbl_kategori";
$stmt = $pdo->query($query);

// Ambil hasil query
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kirim data dalam format JSON
echo json_encode($data);
?>
