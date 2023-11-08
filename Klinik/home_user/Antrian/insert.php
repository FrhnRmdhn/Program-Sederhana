<?php
session_start();
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  $koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // membuat "no_antrian"
  // sql statement untuk menampilkan data "no_antrian" terakhir pada tabel "data_antrian" berdasarkan "tanggal"
  $query = mysqli_query($koneksi, "SELECT max(no_antrian) as nomor FROM data_antrian WHERE tanggal_antrian='$tanggal'")
    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
  // ambil jumlah baris data hasil query
  $rows = mysqli_num_rows($query);

  // cek hasil query
  // jika "no_antrian" sudah ada
  if ($rows <> 0) {
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
    // "no_antrian" = "no_antrian" yang terakhir + 1
    $no_antrian = $data['nomor'] + 1;
  }
  // jika "no_antrian" belum ada
  else {
    // "no_antrian" = 1
    $no_antrian = 1;
  }

  $id = $_SESSION['id_pasien'];
  $status = "antri";

  // sql statement untuk insert data ke tabel "data_antrian"
  $insert = mysqli_query($koneksi, "INSERT INTO data_antrian(tanggal_antrian, no_antrian, id_pasien) 
                                   VALUES('$tanggal', '$no_antrian','$id')")
    or die('Ada kesalahan pada query insert : ' . mysqli_error($koneksi));

  // sql statement untuk update status pasien di tabel "data_pasien"
  $sql1 = mysqli_query($koneksi, "UPDATE data_pasien SET status_pasien = '$status' WHERE id_pasien = '$id'")
    or die('Ada kesalahan pada query update : ' . mysqli_error($koneksi));

  // cek query
  // jika proses insert dan update berhasil
  if ($insert && $sql1) {
    // tampilkan pesan sukses insert data
    echo "Sukses";
  }
}
