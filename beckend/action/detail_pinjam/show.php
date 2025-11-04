<?php
include '../../../config/conection.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id_detail_pinjam']) || empty($_GET['id_detail_pinjam'])) {
    echo "
        <script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/detail_pinjam/index.php';
        </script>
    ";
    exit;
}

// Sanitasi ID
$id_detail_pinjam = intval($_GET['id_detail_pinjam']);

// Ambil data detail_pinjam
$qSelect = "SELECT * FROM detail_pinjam WHERE id_detail_pinjam = $id_detail_pinjam";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href = '../../pages/detail_pinjam/index.php';
        </script>
    ";
    exit;
}

$detail_pinjam = mysqli_fetch_assoc($result); // Ubah ke assoc untuk konsistensi
?>