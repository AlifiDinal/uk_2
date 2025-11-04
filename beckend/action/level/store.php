<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id_level = strtolower(escapeString($_POST['id_level']));
    $nama_level = escapeString($_POST['nama_level']);

    $qInsert = "INSERT INTO level (id_level, nama_level) 
                VALUES('$id_level', '$nama_level')";

    
    if (mysqli_query($connect, $qInsert)) {
        echo "<script>alert('Data Berhasil Ditambah'); window.location.href='../../pages/level/index.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Ditambah'); window.location.href='../../pages/level/index.php';</script>";
    }
}
?>
