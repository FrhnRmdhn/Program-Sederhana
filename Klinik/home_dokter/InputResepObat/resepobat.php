<?php
    session_start();
    include '../../koneksi.php';
    $id_akun = $_SESSION['id_akun'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Resep Obat</title>

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
    $status_pasien = 'selesai';
    $id_pasien = $_POST['id_pasien'];
    $id_pemeriksaan = $_POST['id_pemeriksaan'];
    $tgl_resep = $_POST['tgl_resep'];
    $namaobat_resep = $_POST['namaobat_resep'];
    $jenisobat_resep = $_POST['jenisobat_resep'];
    $aturanpemakaian_resep = $_POST['aturanpemakaian_resep'];

    $simpan = mysqli_query($koneksi, "INSERT INTO data_resepobat (id_pemeriksaan, id_pasien, id_akun, tgl_resep, namaobat_resep, jenisobat_resep, aturanpemakaian_resep) VALUES ('$id_pemeriksaan','$id_pasien','$id_akun', '$tgl_resep', '$namaobat_resep','$jenisobat_resep', '$aturanpemakaian_resep')");
    $simpan2 = mysqli_query($koneksi, "UPDATE data_pasien SET status_pasien='$status_pasien' where id_pasien='$id_pasien'");
    $simpan3 = mysqli_query($koneksi, "DELETE from data_antrian where id_pasien='$id_pasien'");

    //jika tombol INPUT di klik maka pesan muncul
    if ($simpan && $simpan2 && $simpan3) {
        echo "<script>
    alert('Simpan Data Sukses');
    document.location = 'resepobat.php';
    </script> ";
    } else {
        echo "<script>
    alert('Gagal Menyimpan Data');
    document.location = 'resepobat.php';
    </script> ";
    }
}

?>


<body class="bg-info">
    <!-- Container Berfungsi Agar Data Input Ke Tengah -->
    <div class="container">
        <!-- p : berfungsi mengatur besar border, mb : berfungsi mengatur jarak bawah -->
        <div class="p-1 mb-1 bg-success text-white">
            <h3 align="center">Input Resep Obat</h3>
        </div>

        <!-- Awal FORM Input Data Pasien  -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Form Input
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class=" form-group">

                        <label class="mt-2">Nama Pasien</label>
                        <select class="form-control" name="id_pasien" id="selectPasien">
                            <option value="">-PILIH-</option>
                            <?php
                            $cek_pasien = mysqli_query($koneksi, "SELECT * FROM data_pasien
                                                            INNER JOIN data_antrian
                                                            ON data_pasien.id_pasien = data_antrian.id_pasien  
                                                            INNER JOIN data_pemeriksaan
                                                            ON data_pasien.id_pasien = data_pemeriksaan.id_pasien
                                                            WHERE data_pasien.status_pasien = 'pemeriksaan' 
                                                            ORDER BY data_antrian.id_antrian ASC");
                            while ($baris = mysqli_fetch_assoc($cek_pasien)) {
                                
                            ?>
                                <option value="<?= $baris['id_pasien']; ?>" data-idpemeriksaan="<?= $baris['id_pemeriksaan']; ?>">
                                    <?= $baris['no_antrian']; ?> - <?= $baris['nama_pasien']; ?>
                                </option>
                                <?php } ?>
                        </select>

                        <input type="hidden" name="id_pemeriksaan" id="idPemeriksaanInput">
                        <input type="hidden" name="id_akun" value="<?= $id_akun ?>">

                        <label class="mt-2">Tanggal Resep Diberikan</label>
                        <input type="date" name="tgl_resep" class="form-control" required>

                        <label class="mt-2">Nama Obat</label>
                        <input type="text" name="namaobat_resep" class="form-control" required>

                        <label class="mt-2">Jenis Obat</label>
                        <input type="text" name="jenisobat_resep" class="form-control" required>

                        <label class="mt-2">Aturan Pemakaian</label>
                        <input type="text" name="aturanpemakaian_resep" class="form-control" required>

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
                        <th>Nama Pasien</th>
                        <th>Tanggal Resep</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th>Aturan Pemakaian</th>
                        <th>Aksi</th>
                    </tr>


                    <!-- Penginputan, agar data masuk ke table data pasien dan bertambah data -->
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM data_resepobat
                                            INNER JOIN data_pasien ON data_resepobat.id_pasien = data_pasien.id_pasien");
                    while ($data = mysqli_fetch_array($tampil)) {

                        $id_resep = $data['id_resep'];
                        $nama_pasien = $data['nama_pasien'];
                        $id_akun = $data['id_akun'];
                        $tgl_resep = $data['tgl_resep'];
                        $namaobat_resep = $data['namaobat_resep'];
                        $jenisobat_resep = $data['jenisobat_resep'];
                        $aturanpemakaian_resep = $data['aturanpemakaian_resep'];
                    ?>

                        <tr align="center">
                            <td><?= $no++; ?></td>
                            <td><?= $nama_pasien ?></td>
                            <td><?= $tgl_resep ?></td>
                            <td><?= $namaobat_resep ?></td>
                            <td><?= $jenisobat_resep ?></td>
                            <td><?= $aturanpemakaian_resep ?></td>

                            <!-- BUTTON AKSI -->
                            <td>
                                <!-- Edit -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $id; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
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

<script>
    // Ambil elemen dropdown dan input id_pemeriksaan
    var selectPasien = document.getElementById("selectPasien");
    var idPemeriksaanInput = document.getElementById("idPemeriksaanInput");

    // Tambahkan event listener untuk menangkap perubahan nilai dropdown
    selectPasien.addEventListener("change", function() {
        // Ambil nilai data-idpemeriksaan dari opsi yang dipilih
        var selectedOption = selectPasien.options[selectPasien.selectedIndex];
        var idPemeriksaan = selectedOption.getAttribute("data-idpemeriksaan");

        // Setel nilai input id_pemeriksaan dengan nilai data-idpemeriksaan
        idPemeriksaanInput.value = idPemeriksaan;
    });
</script>

</html>