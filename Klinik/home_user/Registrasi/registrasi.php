<!DOCTYPE html>
<html lang="en">

<!-- Agar Terkoneksi Ke Database -->
<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Pasien</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="../css/inputpasien.css">

    <!-- File Bootstrap  js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</head>

<!-- FORM INI BERFUNGSI UNTUK MENANGKAP DATA YANG BERHASIL DI INPUTKAN DAN MENYIMPAN KE DALAM DATABASE  -->

<?php
//koneksi database


$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');;

// menginput data ke database
if (isset($_POST['Binput'])) {

    $nama_pasien = $_POST['nama_pasien'];
    $alamat_pasien = $_POST['alamat_pasien'];
    $tgllahir_pasien = $_POST['tgllahir_pasien'];
    $jenkel_pasien = $_POST['jenkel_pasien'];
    $notlpn_pasien = $_POST['notlpn_pasien'];
    $email_pasien = $_POST['email_pasien'];
    $username_pasien = $_POST['username_pasien'];
    $password_pasien = $_POST['password_pasien'];

    $simpan = mysqli_query($koneksi, "INSERT INTO data_pasien (nama_pasien, alamat_pasien, tgllahir_pasien, jenkel_pasien, notlpn_pasien, email_pasien, username_pasien, password_pasien) VALUES ('$nama_pasien', '$alamat_pasien', '$tgllahir_pasien', '$jenkel_pasien', '$notlpn_pasien', '$email_pasien', '$username_pasien', '$password_pasien')");

    //jika tombol INPUT di klik maka pesan muncul
    if ($simpan) {
        echo "<script>
    alert('Registrasi Data Pasien Sukses');
    document.location = 'registrasi.php';
    </script> ";
    } else {
        echo "<script>
    alert('Gagal Registrasi Data Pasien');
    document.location = 'registrasi.php';
    </script> ";
    }
}
?>

<body class="bg-info">
    <!-- Container Berfungsi Agar Data Input Ke Tengah -->
    <div class="container">
        <!-- p : berfungsi mengatur besar border, mb : berfungsi mengatur jarak bawah -->
        <div class="p-1 mb-1 bg-success text-white">
            <h3 align="center">REGISTRASI PASIEN</h3>
        </div>

        <!-- Awal FORM Input Data Pasien  -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Form Input Data Pasien
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">

                        <label class="">Nama Lengkap</label>
                        <input type="text" name="nama_pasien" class="form-control" required>

                        <label class="mt-2">Alamat</label>
                        <input type="text" name="alamat_pasien" class="form-control" required>

                        <label class="mt-2">Tanggal Lahir</label>
                        <input type="date" name="tgllahir_pasien" class="form-control" required>

                        <label class="mt-2">Jenis Kelamin</label>
                        <select class="form-control" name="jenkel_pasien">
                            <option value="">-</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <label class="mt-2">Nomor Telpon</label>
                        <input type="text" name="notlpn_pasien" class="form-control" required>

                        <label class="mt-2">Email</label>
                        <input type="text" name="email_pasien" class="form-control" required>

                        <label class="mt-2">Username</label>
                        <input type="text" name="username_pasien" class="form-control" required>

                        <label class="mt-2">Password</label>
                        <input type="password" name="password_pasien" class="form-control" required>

                        <div class="tombol text-center mt-3">
                            <!-- BUTTON -->

                            <button type=" submit" class="btn btn-success" name="Binput">REGISTRASI</button>
                            <button type="reset" class="btn btn-warning" name="Breset">RESET</button>
                            <a href="javascript:history.go(-1)" type=" button" class="btn btn-danger">HOME</a>

                            <!-- javascript:history.go(-2) berfungsi untuk kembali ke halaman sebelumnya -->

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir FORM Input Data Pasien   -->

</body>
<script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>

</html>