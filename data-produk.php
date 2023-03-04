<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori | Aisyeh</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- awal header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Project Sample</a></h1>
            <ul>
                <li><a href="dashboard.php"> Dashboard</a></li>
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
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">[+]Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY id_product DESC");
                        if (mysqli_num_rows($produk) > 0) {
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['nama_category'] ?></td>
                                    <td><?php echo $row['name_product'] ?></td>
                                    <td><?php echo $row['price_product'] ?></td>
                                    <td><?php echo $row['dekripsi_product'] ?></td>
                                    <td><img src="produk/<?php echo $row['image_product'] ?>" width="50px"></td>
                                    <td><?php echo $row['status_product'] ?></td>
                                    <td>
                                        <a href="edit-produk.php?id=<?php echo $row['id_product'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['id_product'] ?>" onclick="return confirm('Yakin Ingin Menghapus ?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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