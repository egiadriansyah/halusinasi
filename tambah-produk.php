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
    <title>Dashboard | Aisyeh</title>
    <link rel="stylesheet" href="css/style.css">
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                        while ($r = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo $r['id_category'] ?>"><?php echo $r['nama_category'] ?></option>

                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>

                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) { //ketika tombol di tekan apa yg akan terjadi?
                    // print_r($_FILES['gambar']); //mengambil data gambar
                    //menampung inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    // menampung dari dari dile yg di upload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'produk'.time().'.'.$type2;

                    // echo $type2; //bagian testing
                    // menampung data format file yang di kirimkan
                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                    //validasi format file
                    //!= artinya jika fotmat fille tidk di izikan
                    if(!in_array($type2, $tipe_diizinkan)){
                        echo 'Format file tidak diizinkan';
                    }else {
                        //jika format file sesuai dengan yg ada di dalam array yg dizinkan
                        //proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './produk/'.$newname);
                        // echo 'Berhasil Upload'; Bagian testing

                        //menambahkan data

                        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                            null,
                            '".$kategori."',
                            '".$nama."',
                            '".$harga."',
                            '".$deskripsi."',
                            '".$newname."',
                            '".$status."'
                                ) ");

                        if ($insert) {
                            echo 'Simpan data berhasil';
                        }else{
                            echo 'gagal '.mysqli_error($conn);
                        }
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