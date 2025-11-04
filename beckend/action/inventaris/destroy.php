<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_inventaris']) || empty($_GET['id_inventaris'])) {
    echo "
        <script>
            alert('ID inventaris tidak ditemukan!');
            window.location.href = '../../pages/inventaris/index.php';
        </script>
    ";
    exit;
}

$id_inventaris = intval($_GET['id_inventaris']);

// Hapus data
$qDelete = "DELETE FROM inventaris WHERE id_inventaris = $id_inventaris";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    echo "
        <script>
            alert('Data Berhasil Dihapus');
            window.location.href='../../pages/inventaris/index.php';
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