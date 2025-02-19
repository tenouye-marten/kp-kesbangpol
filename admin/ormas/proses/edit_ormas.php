<?php
session_start();
include '../../../koneksi.php';
include 'OrmasModel.php';
include 'KategoriModel.php';


if (!isset($_SESSION['user'])) {
  header('Location: ../../../login/login.php');
  exit();
}

$user = $_SESSION['user'];

$ormasModel = new OrmasModel($pdo);
$kategoriModel = new KategoriModel($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $nm_organisasi = $_POST['nm_organisasi'];
  $nm_ketua = $_POST['nm_ketua'];
  $nm_sekretaris = $_POST['nm_sekretaris'];
  $nm_bendahara = $_POST['nm_bendahara'];
  $alamat = $_POST['alamat'];
  $keterangan = $_POST['keterangan'];
  $id_kategori = $_POST['id_kategori'];

  // Cek apakah ada file gambar yang diunggah
  $sk = null; // Default null jika tidak ada file baru
  if (isset($_FILES['sk']) && $_FILES['sk']['error'] == UPLOAD_ERR_OK) {
      $uploadDir = "../imgSk/";
      $fileName = basename($_FILES['sk']['name']);
      $fileTmp = $_FILES['sk']['tmp_name'];
      $fileSize = $_FILES['sk']['size'];
      $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      // Validasi file (ekstensi dan ukuran)
      $allowedExtensions = ['jpg', 'jpeg', 'png'];
      $maxFileSize = 2 * 1024 * 1024; // 2MB

      if (!in_array($fileExt, $allowedExtensions)) {
          $_SESSION['error'] = "File harus berupa gambar (JPG, JPEG, PNG).";
          header("Location: ../edit_ormas.php?id=$id");
          exit();
      }

      if ($fileSize > $maxFileSize) {
          $_SESSION['error'] = "Ukuran file gambar tidak boleh lebih dari 2MB.";
          header("Location: ../edit_ormas.php?id=$id");
          exit();
      }

      // Pindahkan file ke folder upload
      $newFileName = uniqid("img_") . "." . $fileExt;
      if (move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
          $sk = $newFileName; // Set nama file baru untuk disimpan di database
      } else {
          $_SESSION['error'] = "Gagal mengunggah file gambar.";
          header("Location: ../edit_ormas.php?id=$id");
          exit();
      }
  }

  // Panggil fungsi update dengan parameter baru
  $result = $ormasModel->updateOrmas($id, $nm_organisasi, $nm_ketua, $nm_sekretaris, $nm_bendahara, $alamat, $keterangan, $id_kategori, $sk);

  if ($result) {
      $_SESSION['message'] = "Data Ormas berhasil diubah.";
      header("Location: ../ormas.php");
  } else {
      $_SESSION['error'] = "Terjadi kesalahan saat mengubah data Ormas.";
      header("Location: ../edit_ormas.php?id=$id");
  }
  exit();
}



$id = $_GET['id'];
$ormas = $ormasModel->getOrmasById($id);
$kategoriList = $kategoriModel->getAllKategori();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Edit-Ormas</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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
            <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo htmlspecialchars($user['nama']); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> <?php echo htmlspecialchars($user['nama']); ?></h6>
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
        <a class="nav-link " href="../ormas/ormas.php">
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
        <a class="nav-link collapsed" href="../../user/user.php">
          <i class="bi bi-person"></i>
          <span>Data User</span>
        </a>
      </li><!-- End Profile Page Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Ormas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">Edit Ormas</li>
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
              <form method="post" enctype="multipart/form-data" class="row g-3">
                <input required type="hidden" name="id" value="<?php echo $ormas['id']; ?>">

                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Organisasi Masyarakat</label>
                  <input required type="text" value="<?php echo $ormas['nm_organisasi']; ?>" name="nm_organisasi" class="form-control" id="inputNanme4">
                </div>

                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Ketua</label>
                  <input required type="text" value="<?php echo $ormas['nm_ketua']; ?>" name="nm_ketua" class="form-control" id="inputNanme4">
                </div>

                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Sekretaris</label>
                  <input required type="text" value="<?php echo $ormas['nm_sekretaris']; ?>" name="nm_sekretaris" class="form-control" id="inputNanme4">
                </div>

                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Bendahara</label>
                  <input required type="text" value="<?php echo $ormas['nm_bendahara']; ?>" name="nm_bendahara" class="form-control" id="inputNanme4">
                </div>

                <div class="col-12">
                  <label for="inputNanme4" class="form-label">alaamat</label>
                  <input required type="text" value="<?php echo $ormas['alamat']; ?>" name="alamat" class="form-control" id="inputNanme4">
                </div>
                <!-- <div class="col-12">
  <label for="inputNanme4" class="form-label">Keterangan</laabel>
  <input required type="text" name="keterangan" class="form-control" id="inputNanme4">
</div> -->

                <div class="col-12">
                <label for="inputNanme4" class="form-label">Keterangan</label>
                <select required id="id_kategori" name="keterangan" class="form-select">

                  <option selected value="<?php echo $ormas['keterangan']; ?>"> <?php echo $ormas['keterangan']; ?></option>
                  <option value="Aktif">Aktif</option>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                </select>
            </div>

            <div class="col-12">
              <label for="inputNanme4" class="form-label">Kategori</label>
              <select required id="id_kategori" name="id_kategori" class="form-select">

                <?php foreach ($kategoriList as $kategori): ?>
                  <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['kategori']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-12">
        <label for="sk" class="form-label">Upload SK Baru (Opsional)</label>
        <input required type="file" class="form-control" id="sk" name="sk" accept=".pdf,.jpg,.jpeg,.png">
        <small class="text-muted">Unggah SK baru jika ingin mengganti file lama.</small>
        <?php if (!empty($ormas['sk'])): ?>
         <img width="100" src="../imgSk/<?php echo $ormas['sk']; ?>" alt="">
        <?php endif; ?>
    </div>



            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
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