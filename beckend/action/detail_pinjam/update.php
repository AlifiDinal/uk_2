<?php
include '../../../config/conection.php';

// Pastikan ada ID
if (!isset($_GET['id_detail_pinjam']) || empty($_GET['id_detail_pinjam'])) {
    echo "
        <script>
            alert('ID detail_pinjam tidak ditemukan!');
            window.location.href = '../../pages/detail_pinjam/index.php';
        </script>
    ";
    exit;
}

$id_detail_pinjam = intval($_GET['id_detail_pinjam']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi data - PERBAIKI NAMA FIELD
    $id_inventaris = intval($_POST['id_inventaris']); // PERBAIKI: id_iventaris -> id_inventaris
    $id_peminjaman = intval($_POST['id_peminjaman']);
    $jumlah = intval($_POST['jumlah']);

    // Validasi data wajib
    if (empty($id_inventaris) || empty($id_peminjaman) || empty($jumlah)) {
        echo "
            <script>
                alert('Semua field wajib diisi!');
                window.history.back();
            </script>
        ";
        exit;
    }

    // Validasi jumlah
    if ($jumlah <= 0) {
        echo "
            <script>
                alert('Jumlah harus lebih dari 0!');
                window.history.back();
            </script>
        ";
        exit;
    }

    // Query update - GUNAKAN PREFIX dan PERBAIKI KOMA
    $query = "
        UPDATE detail_pinjam SET
            id_inventaris = $id_inventaris,
            id_peminjaman = $id_peminjaman,
            jumlah = $jumlah
        WHERE id_detail_pinjam = $id_detail_pinjam
    ";

    if (mysqli_query($connect, $query)) {
        echo "
            <script>
                alert('Data detail pinjam berhasil diperbarui!');
                window.location.href = '../../pages/detail_pinjam/index.php';
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
            window.location.href = '../../pages/detail_pinjam/index.php';
        </script>
    ";
    exit;
}
?>