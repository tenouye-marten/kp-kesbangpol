<?php
include 'UserModel.php';

class UserController {
    private $model;

    public function __construct($pdo) {
        $this->model = new UserModel($pdo);
    }

    // Menambah user
    public function addUser($nama, $email, $password, $alamat, $jenis_kelamin) {
        return $this->model->create($nama, $email, $password, $alamat, $jenis_kelamin);
    }

    // Menampilkan data user berdasarkan ID
    public function getUser($id) {
        return $this->model->getById($id);
    }

    // Menampilkan semua data user
    public function getAllUsers() {
        return $this->model->getAll();
    }

    // Mengedit data user
    public function editUser($id, $nama, $email, $password, $alamat, $jenis_kelamin) {
        return $this->model->update($id, $nama, $email, $password, $alamat, $jenis_kelamin);
    }

    // Menghapus data user
    public function deleteUser($id) {
        return $this->model->delete($id);
    }
}
?>
