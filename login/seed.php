<?php
include '../koneksi.php';

$password = password_hash('password123', PASSWORD_BCRYPT);
$query = "INSERT INTO tbl_user (nama, email, password, alamat, jenis_kelamin) 
          VALUES ('John Doe', 'john@example.com', :password, 'Jl. Merdeka No. 1', 'L')";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    echo "Akun berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan akun.";
}
?>