<!-- DISINI MENGGUNAKAN MODALS -->

<!-- AWAL EDIT MODALS PASIEN -->

<?php
//koneksi database
include '../../koneksi.php';

// menginput data ke database
if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $namapenyakit_pemeriksaan = $_POST['namapenyakit_pemeriksaan'];
    $keluhan_pemeriksaan = $_POST['keluhan_pemeriksaan'];
    $bagiansakit_pemeriksaan = $_POST['bagiansakit_pemeriksaan'];
    $fotorontgen_pemeriksaan = $_FILES['fotorontgen_pemeriksaan']['name'];
    $keterangan_pemeriksaan = $_POST['keterangan_pemeriksaan'];

    if ($fotorontgen_pemeriksaan != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gambar yang bisa diupload 
        $x = explode('.', $fotorontgen_pemeriksaan); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['fotorontgen_pemeriksaan']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $fotorontgen_pemeriksaan; //menggabungkan angka acak dengan nama file sebenarnya

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

            $query = "SELECT * FROM data_pemeriksaan where id = $id";

            $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
            $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
            // Cek apakah file gambar sebelumnya ada di folder foto
            if (is_file("foto/" . $data['foto'])) { // Jika gambar ada
                unlink("foto/" . $data['foto']); // Hapus file gambar sebelumnya yang ada di folder images
            }
            move_uploaded_file($file_tmp, 'foto/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)

            $sql = ("UPDATE data_pemeriksaan SET namapenyakit_pemeriksaan='$namapenyakit_pemeriksaan',keluhan_pemeriksaan='$keluhan_pemeriksaan',bagiansakit_pemeriksaan='$bagiansakit_pemeriksaan',fotorontgen_pemeriksaan='$nama_gambar_baru', keterangan_pemeriksaan='$keterangan_pemeriksaan' where id_pemeriksaan='$id_pemeriksaan'");

        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script> 
            alert('Gambar Harus Berekstensi JPG / PNG'); 
            document.location = 'pemeriksaanpasien.php';
            </script> ";
        }
    } else {
        $sql = ("UPDATE data_pemeriksaan SET namapenyakit_pemeriksaan='$namapenyakit_pemeriksaan',keluhan_pemeriksaan='$keluhan_pemeriksaan',bagiansakit_pemeriksaan='$bagiansakit_pemeriksaan', keterangan_pemeriksaan='$keterangan_pemeriksaan' where id_pemeriksaan='$id_pemeriksaan'");
    }

    if ($koneksi->query($sql) === TRUE) {
        echo "<script> 
        alert('Edit Data Sukses'); 
        document.location = 'pemeriksaanpasien.php'; 
        </script> ";
    }
}
?>
<!-- AKHIR MODALS UNTUK EDIT  -->

<div class="modal fade" id="edit<?= $id_pemeriksaan; ?>" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5  text-primary text-center" id="edit">EDIT DATA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <label class="mt-2">Nama Penyakit</label>
                    <input type="text" name="namapenyakit_pemeriksaan" class="form-control" value="<?= $namapenyakit_pemeriksaan; ?>" required>

                    <label class="mt-2">Nama Penyakit</label>
                    <input type="text" name="keluhan_pemeriksaan" class="form-control" value="<?= $keluhan_pemeriksaan; ?>" required>

                    <label class="mt-2">Keluhan</label>
                    <input type="text" name="keluhan_pemeriksaan" class="form-control" value="<?= $keluhan_pemeriksaan; ?>" required>

                    <label class="mt-2">Bagian Sakit</label>
                    <input type="text" name="bagiansakit_pemeriksaan" class="form-control" value="<?= $bagiansakit_pemeriksaan; ?>" required>

                    <label class="mt-2">Foto Saat Ini</label>
                    <br> <img src="foto/<?= $fotorontgen_pemeriksaan ?>" width="200px" alt="<?= $fotorontgen_pemeriksaan ?>"> <br>

                    <label class="mt-2">Foto Bagian Yang Sakit (Rontgen)</label>
                    <input type="file" name="fotorontgen_pemeriksaan" class="form-control" value="<?= $fotorontgen_pemeriksaan; ?>">

                    <label class="mt-2">Keterangan_pemeriksaan</label>
                    <input type="text" name="keterangan_pemeriksaan" class="form-control" value="<?= $keterangan_pemeriksaan; ?>" required>

            </div>
            <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- AKHIR MODALS UNTUK EDIT  -->

<?php

// <!-- AWAL MODALS HAPUS PASIEN --> 
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $id_pasien = $_POST['id_pasien'];
    $hapus = mysqli_query($koneksi, "delete from data_pemeriksaan where id_pemeriksaan='$id'");
    $update = mysqli_query($koneksi, "UPDATE data_pasien SET status_pasien='antri' where id_pasien='$id_pasien'");
    echo "<script>
        alert('Hapus Data Sukses');
        document.location = 'pemeriksaanpasien.php';
</script> ";
}

?>

<div class=" modal fade" id="delete<?= $id_pemeriksaan; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">HAPUS DATA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $id_pemeriksaan; ?>">
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
                    <p><b>apakah anda ingin menghapus data dengan id <?= $id_pemeriksaan; ?> ? </b></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AKHIR MODALS HAPUS DATA PASIEN -->
<!-- FORM INI BERFUNGSI UNTUK MENANGKAP DATA YANG BERHASIL DI INPUTKAN DAN MENYIMPAN KE DALAM DATABASE  -->