<?php
session_start();
// Include file koneksi
include './koneksi.php';

// Query untuk mengambil data partai politik
$query = "SELECT id,nm_parpol, nm_ketua, nm_sekretaris, nm_bendahara, alamat, periode_kepengurusan,sk FROM tbl_parpol";
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
  <title>About - Logis Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="./admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="about-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Kesbangpol Keerom</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home<br></a></li>
          <!-- <li><a href="about.html"></a></li> -->
         
     
          <li class="dropdown"><a href="#"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="parpol.php">Parpol</a></li>
              <li><a href="ormas.php">Ormas</a></li>
            </ul>
          </li>
        
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="./login/login.php">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Informasi Partai Politik</h1>
        <p>
        Berikut adalah data Partai Politik (Parpol) yang telah resmi terdaftar. Informasi ini mencakup nama partai, struktur kepengurusan, alamat, serta kategori yang menggambarkan bidang kegiatan masing-masing partai. Kami berharap data ini dapat menjadi acuan dalam memahami peran dan kontribusi partai politik dalam pembangunan masyarakat, kemajuan bangsa, dan proses demokrasi."</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Parpol</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section my-5">

      <div class="container">
      <h1 class="mb-4">Data Partai POlitik</h1>

        <div class="row gy-4">

          <div class="col-lg-12 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
        
          <div class="card">
            <div class="card-body">
      
         

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
                    <th>SK</th>
              
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
                        <td scope="row">
    <a href="#" data-bs-toggle="modal" data-bs-target="#modalSk-<?php echo $row['id']; ?>" class="text-decoration-none " style="font-size: small;">
        <i class="bi bi-eye"></i> Lihat SK
    </a>
</td>

<!-- Modal Popup -->
<div class="modal fade" id="modalSk-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalSkLabel-<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSkLabel-<?php echo $row['id']; ?>">SK PARTAI POLITIK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="admin/parpol/imgSk/<?php echo htmlspecialchars($row['sk']); ?>" alt="SK Organisasi" class="img-fluid">
            </div>
        </div>
    </div>
</div>
       
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

    </section><!-- /About Section -->

 

  </main>

  <footer id="footer" class="footer dark-background">

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-about">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="sitename">Kesbangpol Keerom</span>
      </a>
   <div class="social-links d-flex mt-4">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
    </div>



    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>KONTAK</h4>
      <p>Jl Bhayangkara, Asiaman, Kec.Keerom</p>
      <p>Kabupaten Keerom</p>
      <p>Provinsi Papua</p>
      <p class="mt-4">Kode Pos  99468</p>
 </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">KESBANGPOL Keerom</strong></p>
  
</div>

</footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="./admin/assets/js/main.js"></script>

</body>

</html>