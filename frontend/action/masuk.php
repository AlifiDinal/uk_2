<?php
session_start();
include '../../config/conection.php';
include '../../config/escapeString.php';

if (isset($_POST['login'])) {
    $nama_pegawai = escapeString($_POST['nama_pegawai']);
    $nip = escapeString($_POST['nip']);

    // Cek apakah pegawai ada
    $q = "SELECT * FROM pegawai WHERE nama_pegawai = '$nama_pegawai' AND nip = '$nip'";
    $result = mysqli_query($connect, $q);

    if (mysqli_num_rows($result) > 0) {
        $pegawai = mysqli_fetch_assoc($result);

        // Simpan data ke session
        $_SESSION['id_pegawai'] = $pegawai['id_pegawai'];
        $_SESSION['nama_pegawai'] = $pegawai['nama_pegawai'];

        echo "
            <script>
                alert('Berhasil masuk sebagai {$pegawai['nama_pegawai']}');
                window.location.href='../../frontend/index.php';
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
                alert('Nama atau NIP salah!');
                window.history.back();
            </script>
        ";
        exit;
    }
}
?>
