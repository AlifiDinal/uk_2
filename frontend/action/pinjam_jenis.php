<?php
session_start();
include '../../config/conection.php';
include '../../config/escapeString.php';

// Cegah akses langsung tanpa login
if (!isset($_SESSION['id_pegawai'])) {
    echo "
    <script>
        alert('Anda harus login terlebih dahulu!');
        window.location.href='../pages/masuk.php';
    </script>";
    exit;
}

if (isset($_POST['tombol'])) {
    $tanggal_pinjam     = escapeString($_POST['tanggal_pinjam']);
    $tanggal_kembali    = escapeString($_POST['tanggal_kembali']);
    $status_peminjaman  = escapeString($_POST['status_peminjaman']);
    $id_pegawai         = $_SESSION['id_pegawai']; // otomatis dari session

    // Validasi input
    if (empty($tanggal_pinjam) || empty($tanggal_kembali) || empty($status_peminjaman)) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Validasi tanggal
    if (strtotime($tanggal_kembali) < strtotime($tanggal_pinjam)) {
        echo "<script>alert('Tanggal kembali tidak boleh sebelum tanggal pinjam!'); window.history.back();</script>";
        exit;
    }

    // Simpan ke database
    $query = "INSERT INTO peminjaman (tanggal_pinjam, tanggal_kembali, status_peminjaman, id_pegawai)
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $tanggal_pinjam, $tanggal_kembali, $status_peminjaman, $id_pegawai);

    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
            alert('Data peminjaman berhasil disimpan!');
            window.location.href='../index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal menyimpan data: " . addslashes(mysqli_error($connect)) . "');
            window.history.back();
        </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);
} else {
    echo "
    <script>
        alert('Akses tidak sah!');
        window.location.href='../pages/jenis.php';
    </script>";
}
?>
