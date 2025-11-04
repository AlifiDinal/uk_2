<?php
include '../../../config/conection.php';

// Pastikan ada ID
if (!isset($_GET['id_inventaris']) || empty($_GET['id_inventaris'])) {
    echo "
        <script>
            alert('ID tidak ditemukan!');
            window.location.href = '../../pages/inventaris/index.php';
        </script>
    ";
    exit;
}

$id_inventaris = intval($_GET['id_inventaris']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $kondisi = mysqli_real_escape_string($connect, $_POST['kondisi']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $jumlah = intval($_POST['jumlah']);
    $tanggal_register = mysqli_real_escape_string($connect, $_POST['tanggal_register']);
    $id_jenis = intval($_POST['id_jenis']);
    $id_ruang = intval($_POST['id_ruang']);
    $id_petugas = intval($_POST['id_petugas']);
    $kode_inventaris = mysqli_real_escape_string($connect, $_POST['kode_inventaris']);

    // Validasi data wajib
    if (empty($nama) || empty($kondisi) || empty($jumlah) || empty($tanggal_register) || empty($id_jenis) || empty($id_ruang) || empty($id_petugas)) {
        echo "
            <script>
                alert('Semua field wajib diisi!');
                window.history.back();
            </script>
        ";
        exit;
    }

    $query = "
        UPDATE inventaris SET
            nama = '$nama',
            kondisi = '$kondisi',
            keterangan = '$keterangan',
            jumlah = $jumlah,
            tanggal_register = '$tanggal_register',
            id_jenis = $id_jenis,
            id_ruang = $id_ruang,
            id_petugas = $id_petugas,
            kode_inventaris = '$kode_inventaris'
        WHERE id_inventaris = $id_inventaris
    ";

    if (mysqli_query($connect, $query)) {
        echo "
            <script>
                alert('Data inventaris berhasil diperbarui!');
                window.location.href = '../../pages/inventaris/index.php';
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
            window.location.href = '../../pages/inventaris/index.php';
        </script>
    ";
    exit;
}
?>