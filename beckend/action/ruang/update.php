<?php
include '../../../config/conection.php';

// Pastikan ada ID
if (!isset($_GET['id_ruang']) || empty($_GET['id_ruang'])) {
    echo "<script>alert('ID ruang tidak ditemukan!');window.location.href='../../pages/ruang/index.php';</script>";
    exit;
}

$id_ruang = intval($_GET['id_ruang']);

// Cek apakah data exist
$checkQuery = "SELECT * FROM ruang WHERE id_ruang = $id_ruang";
$checkResult = mysqli_query($connect, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    echo "<script>alert('Data ruang tidak ditemukan!');window.location.href='../../pages/ruang/index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_ruang = mysqli_real_escape_string($connect, $_POST['nama_ruang']);
    $kode_ruang = mysqli_real_escape_string($connect, $_POST['kode_ruang']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);

    // Validasi data wajib
    if (empty($nama_ruang) || empty($kode_ruang)) {
        echo "<script>alert('Nama ruang dan kode ruang wajib diisi!');window.history.back();</script>";
        exit;
    }

    // Query update
    $query = "UPDATE ruang SET 
              nama_ruang = '$nama_ruang', 
              kode_ruang = '$kode_ruang', 
              keterangan = '$keterangan' 
              WHERE id_ruang = $id_ruang";

    // Debug: Tampilkan query
    // echo "<script>console.log('Query:', '" . addslashes($query) . "');</script>";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Data ruang berhasil diperbarui!');window.location.href='../../pages/ruang/index.php';</script>";
    } else {
        $error = mysqli_error($connect);
        echo "<script>alert('Gagal memperbarui data! Error: " . addslashes($error) . "');window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!');window.location.href='../../pages/ruang/index.php';</script>";
    exit;
}
?>