<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Aisyeh Store</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body id="bg-login">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		<?php
		if (isset($_POST['submit'])) {
			session_start();
			include 'koneksi.php';

			// mysqli_real_escape_string($conn, $_POST['user']); //mencegah serangan sql injektion
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '" . $user . "' AND password = '" . MD5($pass) . "'");
			if (mysqli_num_rows($cek) > 0) {
				$d = mysqli_fetch_object($cek);
				$_SESSION['status_login'] = true;
				$_SESSION['a_global'] = $d;
				$_SESSION['id'] = $d->id_admin;

				// bila berhasil masuk ke dashboard.php
				echo '<script>window.location="dashboard.php"</script>';
			} else {
				echo '<script>alert("Username dan Password salah")</script>';
			}
		}
		?>
	</div>
</body>

</html>