<?php
include '../../../config/conection.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id_petugas']) || empty($_GET['id_petugas'])) {
    echo "
        <script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/petugas/index.php';
        </script>
    ";
    exit;
}

// Sanitasi ID
$id_petugas = intval($_GET['id_petugas']);

// Ambil data petugas
$qSelect = "SELECT * FROM petugas WHERE id_petugas = $id_petugas";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href = '../../pages/petugas/index.php';
        </script>
    ";
    exit;
}

$petugas = mysqli_fetch_assoc($result); // Ubah ke assoc untuk konsistensi
?>