<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE id_product = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="data-produk.php"</script>';
}
$p = mysqli_fetch_object($produk);

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Aisyeh</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
</head>

<body>
    <!-- awal header -->
    <header>
        <div class="container">
            <h1><a href=" dashboard.php">Project Sample</a></h1>
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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo $r['id_category'] ?>" <?php echo ($r['id_category'] == $p->id_category) ? 'selected' : ''; ?>><?php echo $r['nama_category'] ?></option>

                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->name_product ?>" required>
                    <input type=" text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->price_product ?>" required>

                    <img src="produk/<?php echo $p->image_product ?>" width="150px">
                    <input type="hidden" name="foto" value="<?php echo $p->image_product ?>">
                    <input type="file" name="gambar" class="input-control">

                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"><?php echo $p->dekripsi_product ?></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->status_product == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->status_product == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) { //ketika tombol di tekan apa yg akan terjadi?

                    //data inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $foto = $_POST['foto'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    if ($filename != '') {
                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk' . time() . '.' . $type2;

                        // menampung data format file yang di kirimkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        //data gambar yg baru
                        if (!in_array($type2, $tipe_diizinkan)) {
                            echo  '<script>alert("Format file tidak diizinkan")</script>';
                        } else {
                            unlink('./produk/' . $foto);
                            move_uploaded_file($tmp_name, './produk/' . $newname);
                            $namagambar = $newname;
                        }
                    } else {
                        $namagambar = $foto;
                    }
                    //jika admin ganti gambar

                    $update = mysqli_query($conn, "UPDATE tb_product SET
                                id_category = '" . $kategori . "',
                                name_product = '" . $nama . "',
                                price_product = '" . $harga . "',
                                dekripsi_product = '" . $deskripsi . "',
                                image_product = '" . $namagambar . "',
                                status_product = '" . $status . "'
                                WHERE id_product = '" . $p->id_product . "' ");

                    if ($update) {
                        echo '<script>alert("Edit Data Berhasil")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($conn);
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>

</html>