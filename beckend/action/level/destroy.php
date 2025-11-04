<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_level']) || empty($_GET['id_level'])) {
    echo "
        <script>
            alert('ID level tidak ditemukan!');
            window.location.href = '../../pages/level/index.php';
        </script>
    ";
    exit;
}

$id_level = intval($_GET['id_level']);

// Cek apakah data exist sebelum menghapus
$checkQuery = "SELECT * FROM level WHERE id_level = $id_level";
$checkResult = mysqli_query($connect, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    echo "
        <script>
            alert('Data level tidak ditemukan!');
            window.location.href = '../../pages/level/index.php';
        </script>
    ";
    exit;
}

// Hapus data - GUNAKAN PREFIX
$qDelete = "DELETE FROM level WHERE id_level = $id_level";
$result = mysqli_query($connect, $qDelete);

if ($result) {
    echo "
        <script>
            alert('Data level berhasil dihapus!');
            window.location.href='../../pages/level/index.php';
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