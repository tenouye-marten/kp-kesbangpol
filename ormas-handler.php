<?php
$pdo = new PDO("mysql:host=localhost;dbname=kesbangpol", "root", "");

// Ambil parameter kategori dari permintaan
$kategoriId = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Query untuk mengambil data
if ($kategoriId !== '') {
    $query = "SELECT o.*, k.kategori AS kategori 
              FROM tbl_ormas o 
              JOIN tbl_kategori k ON o.id_kategori = k.id 
              WHERE o.id_kategori = :kategoriId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':kategoriId', $kategoriId, PDO::PARAM_INT);
} else {
    $query = "SELECT o.*, k.kategori AS kategori 
              FROM tbl_ormas o 
              JOIN tbl_kategori k ON o.id_kategori = k.id";
    $stmt = $pdo->prepare($query);
}

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika data kosong
if (empty($data)) {
    echo json_encode(['message' => 'Data tidak ditemukan.']);
} else {
    echo json_encode($data);
}
