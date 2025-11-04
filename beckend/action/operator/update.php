<?php
include '../../../config/conection.php';

// Pastikan ada ID
if (!isset($_GET['id_petugas']) || empty($_GET['id_petugas'])) {
    echo "
        <script>
            alert('ID petugas tidak ditemukan!');
            window.location.href = '../../pages/petugas/index.php';
        </script>
    ";
    exit;
}

$id_petugas = intval($_GET['id_petugas']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $nama_petugas = mysqli_real_escape_string($connect, $_POST['nama_petugas']);
    $id_level = intval($_POST['id_level']);

    // Validasi data wajib
    if (empty($username) || empty($password) || empty($nama_petugas) || empty($id_level)) {
        echo "
            <script>
                alert('Semua field wajib diisi!');
                window.history.back();
            </script>
        ";
        exit;
    }

    // Query update
    $query = "
        UPDATE petugas SET
            username = '$username',
            password = '$password',
            nama_petugas = '$nama_petugas',
            id_level = $id_level
        WHERE id_petugas = $id_petugas
    ";

    if (mysqli_query($connect, $query)) {
        echo "
            <script>
                alert('Data petugas berhasil diperbarui!');
                window.location.href = '../../pages/operator/index.php';
            </script>
        ";
    } else {
        $error = mysqli_error($connect);
        echo "
            <script>
                alert('Gagal memperbarui data! Error: " . addslashes($error) . "');
                window.history.back();
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('Akses tidak valid!');
            window.location.href = '../../pages/petugas/index.php';
        </script>
    ";
    exit;
}
?>