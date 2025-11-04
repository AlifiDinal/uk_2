<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_petugas']) || empty($_GET['id_petugas'])) {
    echo "
        <script>
            alert('ID petugas tidak ditemukan!');
            window.location.href = '../../pages/operator/index.php';
        </script>
    ";
    exit;
}

$id_petugas = intval($_GET['id_petugas']);

// Cek apakah data exist sebelum menghapus
$checkQuery = "SELECT * FROM petugas WHERE id_petugas = $id_petugas";
$checkResult = mysqli_query($connect, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    echo "
        <script>
            alert('Data petugas tidak ditemukan!');
            window.location.href = '../../pages/petugas/index.php';
        </script>
    ";
    exit;
}

// Hapus data - GUNAKAN PREFIX
$qDelete = "DELETE FROM petugas WHERE id_petugas = $id_petugas";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    echo "
        <script>
            alert('Data petugas berhasil dihapus!');
            window.location.href='../../pages/operator/index.php';
        </script>    
    ";
} else {
    $error = mysqli_error($connect);
    echo "
        <script>
            alert('Data gagal dihapus. Error: " . addslashes($error) . "');
            window.history.back();
        </script> 
    ";
}
?>