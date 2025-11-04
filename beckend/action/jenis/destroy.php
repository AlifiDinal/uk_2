<?php
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_jenis']) || empty($_GET['id_jenis'])) {
    echo "
        <script>
            alert('ID jenis tidak ditemukan!');
            window.location.href = '../../pages/jenis/index.php';
        </script>
    ";
    exit;
}

$id_jenis = intval($_GET['id_jenis']);

// Ambil nama file gambar sebelum data dihapus
$qSelect = "SELECT image FROM jenis WHERE id_jenis = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id_jenis);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href='../../pages/jenis/index.php';
        </script>
    ";
    exit;
}

// Hapus file gambar jika ada
if (!empty($data['image'])) {
    $filePath = "../../../storages/jenis/" . $data['image'];
    if (file_exists($filePath)) {
        unlink($filePath); // hapus file
    }
}

// Hapus data dari database
$qDelete = "DELETE FROM jenis WHERE id_jenis = ?";
$stmtDelete = mysqli_prepare($connect, $qDelete);
mysqli_stmt_bind_param($stmtDelete, "i", $id_jenis);
$deleteResult = mysqli_stmt_execute($stmtDelete);

if ($deleteResult) {
    echo "
        <script>
            alert('Data dan gambar berhasil dihapus!');
            window.location.href='../../pages/jenis/index.php';
        </script>
    ";
} else {
    $error = mysqli_error($connect);
    echo "
        <script>
            alert('Gagal menghapus data. Error: " . addslashes($error) . "');
            window.history.back();
        </script>
    ";
}
?>
