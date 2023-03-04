<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($kategori) == 0) {
    echo '<script>window.location="data-kategori.php"</script>';
}
$k = mysqli_fetch_object($kategori);

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Aisyeh</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- awal header -->
    <header>
        <div class="container">
            <h1><a href=" dashboard.php">Project Sample</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- akhir header -->

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->nama_category ?>">
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) { //ketika tombol di tekan apa yg akan terjadi?

                    $nama = ucwords($_POST['nama']);

                    $update = mysqli_query($conn, "UPDATE tb_category SET
                    nama_category = '" . $nama . "'
                    WHERE id_category = '" . $k->id_category . "'");

                    if ($update) {
                        echo '<script>alert("Edit Data Berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_errno($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- akhir conten -->

    <!-- footer -->
    <div class="container">
        <small>Copyright &copy; 2023 - Aisyeh</small>
    </div>
    <!-- akhir footer -->
</body>

</html>