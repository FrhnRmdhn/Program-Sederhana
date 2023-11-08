<!-- Koneksi Database -->
<?php

$koneksi = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!$koneksi) {
    echo "Koneksi Gagal";
}
