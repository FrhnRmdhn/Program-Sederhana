<!DOCTYPE html>
<html lang="en">

<!-- Agar Terkoneksi Ke Database -->
<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Resep</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/input_pasien.css">

    <!-- File Bootstrap  js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- FORM TABLE DATA PASIEN  -->

    <div class="container mt-2">
        <!-- p : berfungsi mengatur besar border, mb : berfungsi mengatur jarak bawah -->
        <div class="p-1 bg-primary text-white">
            <h3 align="center">Lihat Resep Obat</h3>
        </div>

        <!-- Awal Card Table Data Pasien  -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Table Data Resep Pasien
            </div>
            <div class="card-body">
                <table class="table table-bordered table table-striped">
                    <tr align="center">
                        <td>Id Pasien</td>
                        <td>Nama Pasien</td>
                        <td>Tanggal Resep</td>
                        <td>Nama Obat Resep</td>
                        <td>Jenis Obat Resep</td>
                        <td>Aturan Pemakaian</td>
                    </tr>


                    <!-- Penginputan, agar data masuk ke table data pasien dan bertambah data -->

                    <?php
                    $tampil = "SELECT * FROM data_resepobat 
                    LEFT JOIN data_pasien ON data_resepobat.id_pasien = data_pasien.id_pasien";


                    $user_res = mysqli_query($koneksi, $tampil);
                    while ($data = mysqli_fetch_assoc($user_res)) {
                        ?>

                    <tr align="center">

                        <td>
                            <?= $data['id_pasien'] ?>
                        </td>
                        <td>
                            <?= $data['nama_pasien'] ?>
                        </td>
                        <td>
                            <?= $data['tgl_resep'] ?>
                        </td>
                        <td>
                            <?= $data['namaobat_resep'] ?>
                        </td>
                        <td>
                            <?= $data['jenisobat_resep'] ?>
                        </td>
                        <td>
                            <?= $data['aturanpemakaian_resep'] ?>
                        </td>

                    </tr>

                    <?php } ?>
                </table>

                <div class="text-center">
                    <a href="../../dashboard/dashboard_user.php" type=" button" class="btn btn-warning"
                        name="Bkembali">KEMBALI</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Card Table Data Pasien   -->

</body>

</html>