<?php
include '../../app.php';

// Pastikan tombol ditekan
if (isset($_POST['tombol'])) {

    // Ambil & amankan data dari form
    $nama            = escapeString($_POST['nama']);
    $kondisi         = escapeString($_POST['kondisi']);
    $keterangan      = escapeString($_POST['keterangan']);
    $jumlah          = intval($_POST['jumlah']);
    $id_jenis        = intval($_POST['id_jenis']);
    $id_ruang        = intval($_POST['id_ruang']);
    $id_petugas      = intval($_POST['id_petugas']);
    $kode_inventaris = escapeString($_POST['kode_inventaris']);
    $tanggal_register = date('Y-m-d'); // otomatis tanggal hari ini

    // Query simpan
    $qInsert = "
        INSERT INTO inventaris 
        (nama, kondisi, keterangan, jumlah, id_jenis, tanggal_register, id_ruang, kode_inventaris, id_petugas)
        VALUES 
        ('$nama', '$kondisi', '$keterangan', '$jumlah', '$id_jenis', '$tanggal_register', '$id_ruang', '$kode_inventaris', '$id_petugas')
    ";

    // Eksekusi query
    if (mysqli_query($connect, $qInsert)) {
        echo "<script>
                alert('✅ Data inventaris berhasil ditambahkan!');
                window.location.href='../../pages/inventaris/index.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Gagal menambahkan data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/inventaris/create.php';
              </script>";
    }
}
?>
