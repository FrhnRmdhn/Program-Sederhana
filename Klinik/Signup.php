<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form SignUp</title>
    <link rel="stylesheet" href="loginstyleku.css">
</head>


<?php
//koneksi database
include 'koneksi.php';

// menginput data ke database
if (isset($_POST['register'])) {

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_akun (nama,username, password, level) VALUES ('$nama', '$username', '$password', '$level')");

    //jika tombol INPUT di klik maka pesan muncul
    if ($simpan) {
        echo "<script>
    alert('Registrasi Akun Berhasil');
    document.location = 'login.php';
    </script> ";
    } else {
        echo "<script>
    alert('Registrasi Akun Gagal');
    document.location = 'registrasi.php';
    </script> ";
    }
}
?>

<body>
    <div class="box">

        <form action="" method="POST">
            <h2>Sign Up</h2>
            <div class="inputBox">
                <input type="text" name="nama" required="required">
                <span>Nama</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="text" name="username" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="inputBox">
                <select class="select" name="level">
                    <option value=admin>Admin</option>
                    <option value=dokter>Dokter</option>
                </select>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
    </div>

</body>

</html>