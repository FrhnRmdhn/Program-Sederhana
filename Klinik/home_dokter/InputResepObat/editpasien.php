<!-- DISINI MENGGUNAKAN MODALS -->

<!-- FORM INI BERFUNGSI UNTUK MENANGKAP DATA YANG BERHASIL DI INPUTKAN DAN MENYIMPAN KE DALAM DATABASE  -->

<!-- AWAL EDIT MODALS PASIEN -->

<?php
//koneksi database
include '../../koneksi.php';

// menginput data ke database
if (isset($_POST['edit'])) {

    // id ini berasal dari data yang akan di post
    $id = $_POST['id'];
    $nama_pasien = $_POST['nama_pasien'];
    $tgl_resep = $_POST['tgl_resep'];
    $nama_obat = $_POST['nama_obat'];
    $jenis_obat = $_POST['jenis_obat'];
    $aturan_pemakaian = $_POST['aturan_pemakaian'];

    $edit = mysqli_query($koneksi, "UPDATE data_resepobat set id='$id',nama_pasien='$nama_pasien',tgl_resep='$tgl_resep',nama_obat='$nama_obat',jenis_obat='$jenis_obat',aturan_pemakaian='$aturan_pemakaian' where id='$id'");


    //jika tombol INPUT di klik maka pesan muncul
    if ($edit) {
        echo "<script>
alert('Edit Data Sukses');
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

<!-- id berasal dari target button edit -->
<div class="modal fade" id="edit<?= $id; ?>" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5  text-primary text-center" id="exampleModalLabel">EDIT DATA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <input type="hidden" name="id" value="<?= $id; ?>" class="form-control">

                    <label>Nama Pasien</label>
                    <input type=" text" name="nama_pasien" value="<?= $nama_pasien; ?>" class="form-control" required>

                    <label>Tgl Resep</label>
                    <input type="date" name="tgl_resep" value="<?= $tgl_resep; ?>" class="form-control" required>

                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" value="<?= $nama_obat; ?>" class="form-control" required>

                    <label>Jenis Obat</label>
                    <input type=" text" name="jenis_obat" value="<?= $jenis_obat; ?>" class="form-control" required>

                    <label>Aturan Pemakaian</label>
                    <input type=" text" name="aturan_pemakaian" value="<?= $aturan_pemakaian; ?>" class="form-control" required>
            </div>
            <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- AKHIR MODALS UNTUK EDIT PASIEN -->

<!-- AWAL MODALS HAPUS DATA PASIEN -->
<?php

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $hapus = mysqli_query($koneksi, "delete from data_resepobat where id_resep='$id'");
    echo "<script>
alert('Hapus Data Sukses');
document.location = 'resepobat.php';
</script> ";
}

?>

<div class="modal fade" id="delete<?= $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">HAPUS DATA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <p><b>apakah anda ingin menghapus data dengan nama <?= $nama_pasien; ?> ? </b></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AKHIR MODALS UNTUK HAPUS DATA PASIEN -->

<!-- AWAL MODALS UNTUK VERIFIKASI PEMERIKSAAN DATA PASIEN -->