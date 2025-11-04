<?php
include '../../../config/conection.php';

// Cek apakah parameter ID ada
if (!isset($_GET['id_ruang']) || empty($_GET['id_ruang'])) {
    echo "
        <script>
            alert('Tidak bisa memilih ID ini');
            window.location.href = '../../pages/ruang/index.php';
        </script>
    ";
    exit;
}

// Sanitasi ID
$id_ruang = intval($_GET['id_ruang']);

// Ambil data ruang
$qSelect = "SELECT * FROM ruang WHERE id_ruang = $id_ruang";
$result = mysqli_query($connect, $qSelect);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location.href = '../../pages/ruang/index.php';
        </script>
    ";
    exit;
}

$ruang = mysqli_fetch_assoc($result); // Ubah ke assoc untuk konsistensi
?>