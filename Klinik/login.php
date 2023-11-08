<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Form Login</title>
	<link rel="stylesheet" href="loginstylee.css">
</head>

<body>

	<div class="box">

		<form action="" method="POST">
			<h2>Sign In</h2>
			<div class="inputBox">
				<input type="text" name="username_akun" required>
				<span>Username</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input type="password" name="password_akun" required>
				<span>Password</span>
				<i></i>
			</div>
			<br>


			<!-- <div class="links">
				<a href="SignUp.php">Signup</a>
			</div> -->

			<input type="submit" name="login" value="Login">
		</form>
	</div>
	</form>
	<!-- CODINGAN PHP -->


	<?php
	include 'koneksi.php';
	session_start();

	if (isset($_POST['login'])) {
		$username = $_POST['username_akun'];
		$password = $_POST['password_akun'];

		$data1 = mysqli_query($koneksi, "SELECT * FROM data_akun WHERE username_akun='$username' AND password_akun='$password'");
		$data2 = mysqli_query($koneksi, "SELECT * FROM data_pasien WHERE username_pasien='$username' AND password_pasien='$password'");


		// Kondisi Ini Untuk Akun Mengarah Ke Tbl Data_Akun
		if (mysqli_num_rows($data1) > 0) {
			$account = mysqli_fetch_array($data1);
			$_SESSION['nama_akun'] = $account['nama_akun'];
			$_SESSION['username_akun'] = $account['username_akun'];
			$_SESSION['level_akun'] = $account['level_akun'];
			$_SESSION['id_akun'] = $account['id_akun'];
				
			if ($account['level_akun'] == 'admin') {
				// SweetAlert untuk login berhasil dan pindah ke halaman admin
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>
						Swal.fire({
							icon: 'success',
							title: 'Login Berhasil',
							text: 'Anda akan diarahkan ke halaman admin.'
						}).then(function() {
							window.location.href = 'dashboard/dashboard_admin.php';
						});
					</script>";
			} elseif ($account['level_akun'] == 'dokter') {
				// SweetAlert untuk login berhasil dan pindah ke halaman dokter
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>
						Swal.fire({
							icon: 'success',
							title: 'Login Berhasil',
							text: 'Anda akan diarahkan ke halaman dokter.'
						}).then(function() {
							window.location.href = 'dashboard/dashboard_dokter.php';
						});
					</script>";
			}

			// Kondisi Ini Untuk Pasien Mengarah Ke Tbl Data_Pasien
		} elseif (mysqli_num_rows($data2) > 0) {
			$account2 = mysqli_fetch_array($data2);
			$_SESSION['nama_pasien'] = $account2['nama_pasien'];
			$_SESSION['username_pasien'] = $account2['username_pasien'];
			$_SESSION['id_pasien'] = $account2['id_pasien'];
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
						Swal.fire({
							icon: 'success',
							title: 'Login Berhasil',
							text: 'Anda akan diarahkan ke halaman user.'
						}).then(function() {
							window.location.href = 'dashboard/dashboard_user.php';
						});
					</script>";
		} else {
			// SweetAlert untuk login gagal
			echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
			echo "<script>
					Swal.fire({
						icon: 'error',
						title: 'Login Gagal',
						text: 'Username atau password salah. Silakan coba lagi.'
					});
				</script>";
		}
	}
	?>

</body>

</html>