<!DOCTYPE html>
<html lang="en">

<!-- Agar Terkoneksi Ke Database -->
<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="../css/inputpasien.css">

    <!-- File Bootstrap  js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</head>

<!-- CODINGAN PHP -->

<?php
//koneksi database

$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');

// menginput data ke database
if (isset($_POST['register'])) {

    $nama_akun = $_POST['nama_akun'];
    $username_akun = $_POST['username_akun'];
    $password_akun = $_POST['password_akun'];
    $level_akun = $_POST['level_akun'];

    $simpan = mysqli_query($koneksi, "INSERT INTO data_akun (nama_akun,username_akun, password_akun, level_akun) VALUES ('$nama_akun', '$username_akun', '$password_akun', '$level_akun')");

    //jika tombol INPUT di klik maka pesan muncul
    if ($simpan) {
        echo "<script>
    alert('Registrasi Akun Berhasil');
    document.location = 'Signup.php';
</script> ";
    } else {
        echo "<script>
    alert('Registrasi Akun Gagal');
    document.location = 'Signup.php';
</script> ";
    }
}
?>

<body>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header bg-primary text-white text-center">
                <h3><b>Create Account</b></h3>
            </div>
            <div class="card-header bg-primary text-white">
                Masukkan Data
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <div class="card-body">

                        <input type="text" class="form-control" name="nama_akun" placeholder="Masukkan Nama" required>

                        <input type="text" class="form-control mt-3" name="username_akun" placeholder="Masukkan Username" required>

                        <input type="password" class="form-control mt-3" name="password_akun" placeholder="Masukkan Password" required>

                        <select class="form-select mt-3" name="level_akun">
                            <option selected>Select Level</option>
                            <option value=admin>Admin</option>
                            <option value=dokter>Dokter</option>
                        </select>


                        <div class="text-center mt-3">
                            <input type="submit" name="register" class="btn btn-primary" value="Tambah">
                            <a href="../../dashboard/dashboard_admin.php" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
</body>

</html>