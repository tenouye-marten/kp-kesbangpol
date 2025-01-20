<?php
// Konfigurasi database
$host = "localhost";    // Ganti sesuai dengan host database Anda
$dbname = "kesbangpol"; // Nama database
$username = "root";     // Ganti dengan username database Anda
$password = "";         // Ganti dengan password database Anda

try {
    // Membuat koneksi
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Atur mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal";
    exit; // Hentikan eksekusi jika koneksi gagal
}
?>
