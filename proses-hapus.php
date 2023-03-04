<?php
include 'koneksi.php';

if (isset($_GET['idk'])) {
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE id_category = '" . $_GET['idk'] . "'");
    echo '<script>window.location="data-kategori.php"</script>';
}
