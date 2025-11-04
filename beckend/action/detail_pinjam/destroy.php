<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_detail_pinjam']) || empty($_GET['id_detail_pinjam'])) {
    echo "
        <script>
            alert('ID detail_pinjam tidak ditemukan!');
            window.location.href = '../../pages/detail_pinjam/index.php';
        </script>
    ";
    exit;
}

$id_detail_pinjam = intval($_GET['id_detail_pinjam']);

// Hapus data
$qDelete = "DELETE FROM detail_pinjam WHERE id_detail_pinjam = $id_detail_pinjam";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    echo "
        <script>
            alert('Data Berhasil Dihapus');
            window.location.href='../../pages/detail_pinjam/index.php';
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