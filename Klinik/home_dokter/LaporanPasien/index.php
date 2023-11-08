<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- p : berfungsi mengatur besar border, mb : berfungsi mengatur jarak bawah -->
        <div class="p-1 mb-1 bg-primary text-white">
            <h3 align="center">Laporan Data Pasien</h3>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                Laporan
            </div>
            <div class="card-body">
                <div class="form-group">
                    <table class="table table-bordered table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Nama Penyakit</th>
                                <th>Keluhan Pemeriksaan</th>
                                <th>Nama Obat</th>
                                <th>Aturan Pemakaian</th>
                                <th>Status pemeriksaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $tampil = "SELECT *
                            FROM data_pasien
                            JOIN data_pemeriksaan ON data_pasien.id_pasien = data_pemeriksaan.id_pasien
                            JOIN data_resepobat ON data_pemeriksaan.id_pemeriksaan = data_resepobat.id_pemeriksaan;
                            ";

                            $user_res = mysqli_query($koneksi, $tampil);
                            while ($data = mysqli_fetch_assoc($user_res)) {
                            ?>


                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_pasien'] ?></td>
                                    <td><?= $data['namapenyakit_pemeriksaan'] ?></td>
                                    <td><?= $data['keluhan_pemeriksaan'] ?></td>
                                    <td><?= $data['namaobat_resep'] ?></td>
                                    <td><?= $data['aturanpemakaian_resep'] ?></td>
                                    <td><?= $data['status_pasien'] ?></td>
                                    <td>
                                        <!-- PrintSatu -->
                                        <a href="printsatu.php?id=<?= $data['id_pasien']; ?>">
                                            <button type="button" class="btn btn-warning"">
                                         <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                </tr>

                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <a href="printsemua.php" class="btn btn-primary">Print Semua</a>
                        
                     
                    <a href="../../dashboard/dashboard_admin.php" type=" button" class="btn btn-warning" name="Bkembali">KEMBALI</a>
             
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>