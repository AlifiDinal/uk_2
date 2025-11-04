<?php
include '../../../config/conection.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id_inventaris']) || empty($_GET['id_inventaris'])) {
    echo "
        <script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/inventaris/index.php';
        </script>
    ";
    exit;
}

// Sanitasi ID
$id_inventaris = intval($_GET['id_inventaris']);

// Ambil data inventaris
$qSelect = "SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href = '../../pages/inventaris/index.php';
        </script>
    ";
    exit;
}

$inventaris = mysqli_fetch_assoc($result); // Ubah ke assoc untuk konsistensi
?>