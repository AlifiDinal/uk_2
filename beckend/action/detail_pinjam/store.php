<?php
include '../../../config/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_detail_pinjam = intval($_POST['id_detail_pinjam']);
    $id_peminjaman = intval($_POST['id_peminjaman']);
    $id_inventaris = mysqli_real_escape_string($connect, $_POST['id_inventaris']);
    $jumlah = mysqli_real_escape_string($connect, $_POST['jumlah']);

    $query = "INSERT INTO detail_pinjam (id_detail_pinjam, id_peminjaman, id_inventaris, jumlah)
              VALUES ('$id_detail_pinjam', '$id_peminjaman', '$id_inventaris', '$jumlah')";

    if (mysqli_query($connect, $query)) {
        echo "<script>
                alert('Data detail_pinjam berhasil ditambahkan!');
                window.location.href='../../pages/detail_pinjam/index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . mysqli_error($connect) . "');
                window.history.back();
              </script>";
    }
}
?>
