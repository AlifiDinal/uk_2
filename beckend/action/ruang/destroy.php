<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_ruang']) || empty($_GET['id_ruang'])) {
    echo "
        <script>
            alert('ID ruang tidak ditemukan!');
            window.location.href = '../../pages/ruang/index.php';
        </script>
    ";
    exit;
}

$id_ruang = intval($_GET['id_ruang']);

// Hapus data
$qDelete = "DELETE FROM ruang WHERE id_ruang = $id_ruang";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    echo "
        <script>
            alert('Data Berhasil Dihapus');
            window.location.href='../../pages/ruang/index.php';
        </script>    
    ";
} else {
    $error = mysqli_error($connect);
    echo "
        <script>
            alert('Data Gagal Dihapus. Error: " . addslashes($error) . "');
            window.history.back();
        </script> 
    ";
}
?>