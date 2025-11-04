<?php
include '../../../config/conection.php';

// Pastikan request berasal dari form (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Ambil data dari form dengan sanitasi
  $id_ruang     = intval($_POST['id_ruang']);
  $nama_ruang   = mysqli_real_escape_string($connect, $_POST['nama_ruang']);
  $kode_ruang   = mysqli_real_escape_string($connect, $_POST['kode_ruang']);
  $keterangan   = mysqli_real_escape_string($connect, $_POST['keterangan']);

  // Validasi sederhana
  if (empty($nama_ruang) || empty($kode_ruang)) {
    echo "<script>
            alert('Nama ruang dan kode ruang tidak boleh kosong!');
            window.history.back();
          </script>";
    exit;
  }

  // Cek apakah kode ruang sudah digunakan
  $checkKode = mysqli_query($connect, "SELECT * FROM ruang WHERE kode_ruang = '$kode_ruang'");
  if (mysqli_num_rows($checkKode) > 0) {
    echo "<script>
            alert('Kode ruang sudah digunakan! Silakan gunakan kode lain.');
            window.history.back();
          </script>";
    exit;
  }

  // Query insert
  $query = "
    INSERT INTO ruang (id_ruang, nama_ruang, kode_ruang, keterangan)
    VALUES ('$id_ruang', '$nama_ruang', '$kode_ruang', '$keterangan')
  ";

  $result = mysqli_query($connect, $query);

  // Feedback hasil
  if ($result) {
    echo "<script>
            alert('Data ruang berhasil ditambahkan!');
            window.location.href='../../pages/ruang/index.php';
          </script>";
  } else {
    echo "<script>
            alert('Gagal menambahkan data ruang: " . mysqli_error($connect) . "');
            window.history.back();
          </script>";
  }

} else {
  // Jika bukan metode POST
  echo "<script>
          alert('Akses tidak valid!');
          window.history.back();
        </script>";
}
?>
