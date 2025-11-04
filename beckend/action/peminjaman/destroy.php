<?php
include '../../../config/conection.php';

// Pastikan ada ID
if (!isset($_GET['id_peminjaman']) || empty($_GET['id_peminjaman'])) {
    echo "
        <script>
            alert('ID peminjaman tidak ditemukan!');
            window.location.href = '../../pages/peminjaman/index.php';
        </script>
    ";
    exit;
}

$id_peminjaman = intval($_GET['id_peminjaman']);

// Cek apakah data exist
$checkQuery = "SELECT * FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
$checkResult = mysqli_query($connect, $checkQuery);

if (!$checkResult || mysqli_num_rows($checkResult) === 0) {
    echo "
        <script>
            alert('Data peminjaman tidak ditemukan!');
            window.location.href = '../../pages/peminjaman/index.php';
        </script>
    ";
    exit;
}

// Hapus data
$deleteQuery = "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
$result = mysqli_query($connect, $deleteQuery);

if ($result) {
    echo "
        <script>
            alert('Data peminjaman berhasil dihapus!');
            window.location.href='../../pages/peminjaman/index.php';
        </script>    
    ";
} else {
    $error = mysqli_error($connect);
    echo "
        <script>
            alert('Data Gagal Dihapus. Error: " . addslashes($error) . "');
            window.location.href='../../pages/peminjaman/index.php';
        </script> 
    ";
}
?>