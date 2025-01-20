<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Menambahkan user baru
    public function create($nama, $email, $password, $alamat, $jenis_kelamin) {
        $stmt = $this->pdo->prepare("INSERT INTO tbl_user (nama, email, password, alamat, jenis_kelamin) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $email, password_hash($password, PASSWORD_DEFAULT), $alamat, $jenis_kelamin]);
    }

    // Mengambil data user berdasarkan ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mengambil semua data user
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tbl_user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengupdate data user
    public function update($id, $nama, $email, $password, $alamat, $jenis_kelamin) {
        $stmt = $this->pdo->prepare("UPDATE tbl_user SET nama = ?, email = ?, password = ?, alamat = ?, jenis_kelamin = ? WHERE id = ?");
        return $stmt->execute([$nama, $email, password_hash($password, PASSWORD_DEFAULT), $alamat, $jenis_kelamin, $id]);
    }

    // Menghapus data user
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tbl_user WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
