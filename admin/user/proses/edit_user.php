<?php
session_start();
include '../../../koneksi.php';
// include 'UserModel.php';
include 'UserController.php';



if (!isset($_SESSION['user'])) {
  header('Location: ../../../login/login.php');
  exit();
}

$user = $_SESSION['user'];

// Inisialisasi controller
// Inisialisasi controller
$userController = new UserController($pdo);

// Cek apakah ada ID yang diberikan
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $user = $userController->getUser($id);
}

// Proses edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    if ($userController->editUser($id, $nama, $email, $password, $alamat, $jenis_kelamin)) {
        $_SESSION['message'] = "Data User berhasil diubah.";
        header("Location: ../user.php");
    } else {
        header("Location: ../user.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Edit-User</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">ADMIN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

   

      
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">              <?php echo htmlspecialchars($user['nama']); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>              <?php echo htmlspecialchars($user['nama']); ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../../login/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

<li class="nav-item">
  <a class="nav-link collapsed" href="../../dashboard.php">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->





<li class="nav-heading">Data Master</li>

<li class="nav-item ">
  <a class="nav-link collapsed" href="../../parpol/parpol.php">
    <i class="bi bi-person"></i>
    <span>Data Parpol</span>
  </a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
  <a class="nav-link collapsed " href="../../ormas/ormas.php">
    <i class="bi bi-person"></i>
    <span>Data Ormas</span>
  </a>
</li><!-- End Profile Page Nav -->



<li class="nav-item">
  <a class="nav-link collapsed" href="../../kategori/kategori.php">
    <i class="bi bi-person"></i>
    <span>Kategori</span>
  </a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
  <a class="nav-link " href="#">
    <i class="bi bi-person"></i>
    <span>Data User</span>
  </a>
</li><!-- End Profile Page Nav -->



</ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

<div class="pagetitle">
  <h1>Edit User</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item">Edit User</li>
     
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
 

    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Edit</h5>

          <!-- Vertical Form -->
          <form method="post"  class="row g-3">
<input type="hidden" name="id" id="" value="<?= $user['id']?>">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Nama</label>
              <input type="text" name="nama"  value="<?= htmlspecialchars($user['nama']) ?>" class="form-control" id="inputNanme4">
            </div>

            <div class="col-12">
              <label for="inputNanme4" class="form-label">Email</label>
              <input type="email"  value="<?= htmlspecialchars($user['email']) ?>" name="email" class="form-control" id="inputNanme4">
            </div>

            <div class="col-12">
              <label for="inputNanme4" class="form-label">Password     <small style="font-size: 12px;" class="text-danger">(Biarkan kosong jika tidak ingin mengubah password)</small>
              </label>
              <input type="password"   name="password" class="form-control" id="inputNanme4">
          
            </div>

            <div class="col-12">
              <label for="inputNanme4" class="form-label">Alamat</label>
              <input type="text" name="alamat" value="<?= htmlspecialchars($user['alamat']) ?>" class="form-control" id="inputNanme4">
            </div>

         
       

            <select id="id_kategori" name="jenis_kelamin" class="form-select">
         
                    <option selected  value="<?= htmlspecialchars($user['jenis_kelamin']) ?>"> <?= htmlspecialchars($user['jenis_kelamin']) ?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                
                    </select>
        

         
            <div class="text-center">
              <button type="submit" name="edit_user" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>

   

    </div>
  </div>
</section>

</main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Kesbangpol</span></strong>
    </div>
 
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>