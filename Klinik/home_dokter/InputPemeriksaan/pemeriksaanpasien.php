<?php
    session_start();
    include '../../koneksi.php';
    $id_akun = $_SESSION['id_akun'];
?>

<!DOCTYPE html>
<html lang="en">

<!-- Agar Terkoneksi Ke Database -->


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
include '../../koneksi.php';

// menginput data ke database
if (isset($_POST['Binput'])) {


    $id_akun = $_POST['id_akun'];
    $status_pasien = $_POST['status_pasien'];
    $id_pasien = $_POST['id_pasien'];
    $namapenyakit_pemeriksaan = $_POST['namapenyakit_pemeriksaan'];
    $keluhan_pemeriksaan = $_POST['keluhan_pemeriksaan'];
    $bagiansakit_pemeriksaan = $_POST['bagiansakit_pemeriksaan'];
    $fotorontgen_pemeriksaan = $_FILES['fotorontgen_pemeriksaan']['name'];
    $keterangan_pemeriksaan = $_POST['keterangan_pemeriksaan'];

    if ($fotorontgen_pemeriksaan != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gambar yang bisa diupload 
        $x = explode('.', $fotorontgen_pemeriksaan); //memisahkan nama file dengan ekstensi yang diupload => nama_file.jpg || nama_file || jpg
        $ekstensi = strtolower(end($x)); // jpg,png.jpeg
        $file_tmp = $_FILES['fotorontgen_pemeriksaan']['tmp_name']; // tempat file 
        $angka_acak     = rand(1, 999); // Membuat nama file dengan mengambil angka acak
        $nama_gambar_baru = $angka_acak . '-' . $fotorontgen_pemeriksaan; //menggabungkan angka acak dengan nama file sebenarnya

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'foto/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $simpan = mysqli_query($koneksi, "INSERT INTO data_pemeriksaan (id_pasien,id_akun,namapenyakit_pemeriksaan,keluhan_pemeriksaan,bagiansakit_pemeriksaan,fotorontgen_pemeriksaan,keterangan_pemeriksaan) VALUES ('$id_pasien', '$id_akun', '$namapenyakit_pemeriksaan','$keluhan_pemeriksaan', '$bagiansakit_pemeriksaan', '$nama_gambar_baru','$keterangan_pemeriksaan')");
            $simpan2 = mysqli_query($koneksi, "UPDATE data_pasien SET status_pasien='$status_pasien' where id_pasien='$id_pasien'");
        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script> 
            alert('Gambar Harus Berekstensi JPG / PNG'); 
            document.location = 'pemeriksaanpasien.php'; 
            </script> ";
        }
    }

    //jika tombol INPUT di klik maka pesan muncul
    if ($simpan && $simpan2) {
        echo "<script>
        alert('Simpan Data Sukses');
        document.location = 'pemeriksaanpasien.php';
        </script> ";
    } else {

        echo "<script>
        alert('Gagal Menyimpan Data');
        document.location = 'pemeriksaanpasien.php';
        </script> ";
    }
}
?>


<body class="bg-info">
    <!-- Container Berfungsi Agar Data Input Ke Tengah -->
    <div class="container">
        <!-- p : berfungsi mengatur besar border, mb : berfungsi mengatur jarak bawah -->
        <div class="p-1 mb-1 bg-success text-white">
            <h3 align="center">Pemeriksaan / Diagnosa Penyakit</h3>
        </div>

        <!-- Awal FORM Input Data Pasien  -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Form Input
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                     <input type="hidden" name="id_akun" class="form-control" value="<?= $id_akun; ?>" readonly>
                     
                     <label class="mt-2">Nama Pasien</label>
                        <select class="form-control" name="id_pasien">
                            <option value="">-PILIH-</option>
                            <?php
                            $cek_pasien = mysqli_query($koneksi, "SELECT * FROM data_pasien
                                                        INNER JOIN data_antrian
                                                        ON data_pasien.id_pasien = data_antrian.id_pasien  where data_pasien.status_pasien = 'antri' order by data_antrian.id_antrian asc");
                            while ($baris = mysqli_fetch_assoc($cek_pasien)) {

                            ?>
                                <option value="<?= $baris['id_pasien']; ?>"><?= $baris['no_antrian']; ?> - <?= $baris['nama_pasien']; ?>
                                <?php } ?>
                        </select>

                        <label class="mt-2">Nama Penyakit</label>
                        <input type="text" name="namapenyakit_pemeriksaan" class="form-control" required>

                        <label class="mt-2">Keluhan</label>
                        <input type="text" name="keluhan_pemeriksaan" class="form-control" required>

                        <label class="mt-2">Bagian Sakit</label>
                        <input type="text" name="bagiansakit_pemeriksaan" class="form-control" required>

                        <label class="mt-2">Foto Bagian Yang Sakit (Rontgen)</label>
                        <input type="file" name="fotorontgen_pemeriksaan" class="form-control" required>

                        <label class="mt-2">Keterangan</label>
                        <input type="text" name="keterangan_pemeriksaan" class="form-control" required>

                        <input type="hidden" name="status_pasien" class="form-control" value="pemeriksaan" readonly>

                        <div class="tombol text-center mt-3">
                            <!-- BUTTON -->
                            <button type=" submit" class="btn btn-success" name="Binput">INPUT</button>
                            <button type="reset" class="btn btn-warning" name="Breset">RESET</button>
                            <a href="../../dashboard/dashboard_dokter.php" type=" button" class="btn btn-danger" name="Bkembali">KEMBALI</a>
                            <!-- javascript:history.go(-1) berfungsi untuk kembali ke halaman sebelumnya -->

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir FORM    -->

    <!-- Awal Card Table Data Pasien  -->
    <div class=" container mt-2">

        <div class="card ">
            <div class="card-header bg-primary text-white">
                Table Data Pasien
            </div>
            <div class="card-body">
                <table class="table table-bordered table table-striped">
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Penyakit</th>
                        <th>Keluhan</th>
                        <th>Bagian Sakit</th>
                        <th>Foto</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>


                    <!-- Penginputan, agar data masuk ke table data pasien dan bertambah data -->
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM data_pemeriksaan");
                    while ($data = mysqli_fetch_array($tampil)) {

                        $id_pemeriksaan = $data['id_pemeriksaan'];
                        $id_pasien = $data['id_pasien'];
                        $namapenyakit_pemeriksaan = $data['namapenyakit_pemeriksaan'];
                        $keluhan_pemeriksaan = $data['keluhan_pemeriksaan'];
                        $bagiansakit_pemeriksaan = $data['bagiansakit_pemeriksaan'];
                        $fotorontgen_pemeriksaan = $data['fotorontgen_pemeriksaan'];
                        $keterangan_pemeriksaan = $data['keterangan_pemeriksaan'];
                    ?>

                        <tr align="center">
                            <td><?= $no++; ?></td>
                            <td><?= $data['namapenyakit_pemeriksaan'] ?></td>
                            <td><?= $data['keluhan_pemeriksaan'] ?></td>
                            <td><?= $data['bagiansakit_pemeriksaan'] ?></td>
                            <td><img src="foto/<?= $fotorontgen_pemeriksaan  ?>" alt="<?= $fotorontgen_pemeriksaan  ?>" width="200px"></td>
                            <td><?= $data['keterangan_pemeriksaan'] ?></td>

                            <!-- BUTTON AKSI -->
                            <td>
                                <!-- Edit -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $id_pemeriksaan; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id_pemeriksaan; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>

                            </td>
                            <!-- AKHIR BUTTON AKSI -->

                        </tr>

                        <?php include 'editpasien.php';  ?>
                        <!-- DISINI DIHUBUNGKAN UNTUK EDIT KE MODALS AGAR EDIT MODEL POPUP -->

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Akhir Card Table Data Pasien   -->

</body>
<script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>

</html>