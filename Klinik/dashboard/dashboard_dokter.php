<?php
session_start();
$nama_akun = $_SESSION['nama_akun'];
$id_akun = $_SESSION['id_akun'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Form Dokter </title>
  <link rel="stylesheet" href="style.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <nav>
    <div class="navbar">
      <div class="logo"><a href="#">Klinik</a></div>
      <ul class="nav-links">
        <li><a href="../home_dokter/LihatAntrianPasien/Lihatantrian.php">Lihat Antrian Pasien</a></li> |
        <li><a href="../home_dokter/InputPemeriksaan/pemeriksaanpasien.php">Input Pemeriksaan</a></li> |
        <li><a href="../home_dokter/InputResepObat/resepobat.php">Input Resep Obat</a></li> |
        <li><a href="../home_dokter/LaporanPasien/index.php">Laporan Pasien</a></li> |
        <li><a href="../login.php">Logout</a></li>
      </ul>
      <div class="appearance">
        <div class="light-dark">
          <i class="btn fas fa-moon" data-color="#e4e6eb #e4e6eb #24292D #24292D #242526"></i>
        </div>
        <div class="color-icon">
          <div class="icons">
            <i class="fas fa-palette"></i>
            <i class="fas fa-sort-down arrow"></i>
          </div>
          <div class="color-box">
            <h3>Color Switcher</h3>
            <div class="color-switchers">
              <button class="btn blue active" data-color="#fff #24292d #4070f4 #0b3cc1 #F0F8FF"></button>
              <button class="btn orange" data-color="#fff #242526 #F79F1F #DD8808 #fef5e6"></button>
              <button class="btn purple" data-color="#fff #242526 #8e44ad #783993 #eadaf1"></button>
              <button class="btn green" data-color="#fff #242526 #3A9943 #2A6F31 #DAF1DC"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <section class="home-content">
    <div class="texts"><br>
      <h2 class="text">Selamat Datang <?= $nama_akun; ?> </h2>
      <h3 class="text"><span>"Healthy is expensive"</span></h3>
      <p> Seorang dokter melihat rasa sakit, kematian, dan penderitaan setiap hari, tetapi mereka hanya memberikan perawatan dan penyembuhan sehingga Tubuh yang sehat dan baik adalah alasan untuk pikiran yang sehat.😊</p>

  </section>

  <script src="script.js"></script>

</body>

</html>