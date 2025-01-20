<?php
session_start();
// Include file koneksi



if (!isset($_SESSION['user'])) {
    header('Location: ../../login/login.php');
    exit();
}

$user = $_SESSION['user'];


include '../../koneksi.php';

// Query untuk mengambil data partai politik
$query = "SELECT id,nm_parpol, nm_ketua, nm_sekretaris, nm_bendahara, alamat, periode_kepengurusan FROM tbl_parpol";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Simpan hasil query
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

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
        <img src="assets/img/logo.png" alt="">
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
            <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">  <?php echo htmlspecialchars($user['nama']); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6>
              <?php echo htmlspecialchars($user['nama']); ?>
            </h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../login/logout.php">
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
        <a class="nav-link " href="../dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->



  

      <li class="nav-heading">Data Master</li>

      <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="bi bi-person"></i>
          <span>Data Parpol</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../ormas/ormas.php">
          <i class="bi bi-person"></i>
          <span>Data Ormas</span>
        </a>
      </li><!-- End Profile Page Nav -->

    

      <li class="nav-item">
        <a class="nav-link collapsed" href="../kategori/kategori.php">
          <i class="bi bi-person"></i>
          <span>Kategori</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../user/user.php">
          <i class="bi bi-person"></i>
          <span>Data User</span>
        </a>
      </li><!-- End Profile Page Nav -->


   
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">Data Parpol</li>
    
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <a href="proses/tambah-parpol.php" class="btn btn-primary my-4"><i class="bi bi-plus me-1"></i> Tambah </a>
            

            <?php
            // Tampilkan pesan sukses jika ada
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            " . $_SESSION['message'] . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
}
            ?>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>No</th>
                    <th>
                      <b>N</b>ama
                    </th>
                    <th>Alamat</th>
                    <th>Nama Ketua</th>
                    <th>Nama Sekretaris</th>
                    <th>Nama Bendahara</th>
                    <!-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> -->
                    <th>Periode Kepengurusan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($results)): ?>
                <?php $no = 1; // Inisialisasi nomor ?>
                <?php foreach ($results as $row): ?>
                  <tr>
                  <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nm_parpol']) ?></td>
                        <td><?= htmlspecialchars($row['nm_ketua']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td><?= htmlspecialchars($row['nm_sekretaris']) ?></td>
                        <td><?= htmlspecialchars($row['nm_bendahara']) ?></td>
                        <td><?= htmlspecialchars($row['periode_kepengurusan']) ?></td>
                        <td class="action-links">

                        <div class="dropdown">
  <button class="btn btn-sm btn-outline  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
   Aksi
  </button>
  <ul class="dropdown-menu">
    <li>

    <a  href="./proses/edit_parpol.php?id=<?= $row['id'] ?>" class="edit-link  dropdown-item">     <i class="bi bi-pencil-square text-warning"></i>Edit</a> </li>
    <li> 
    <a href="hapus_parpol.php?id=<?= $row['id'] ?>" class="delete-link dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">      <i class="bi bi-trash-fill text-danger"></i>Hapus</a>

    </li>

  </ul>
</div>
                          
                          
                    </td>
                 
                  </tr>
                  <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada data tersedia.</td>
                </tr>
            <?php endif; ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>