<?php
include '../../../config/conection.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id_jenis']) || empty($_GET['id_jenis'])) {
    echo "
        <script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/jenis/index.php';
        </script>
    ";
    exit;
}

// Sanitasi ID
$id_jenis = intval($_GET['id_jenis']);

// Ambil data jenis
$qSelect = "SELECT * FROM jenis WHERE id_jenis = $id_jenis";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href = '../../pages/jenis/index.php';
        </script>
    ";
    exit;
}

$jenis = mysqli_fetch_assoc($result); // Ubah ke assoc untuk konsistensi
?>