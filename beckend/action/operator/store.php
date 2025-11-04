<?php
include '../../../config/conection.php';

// Pastikan form dikirim via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Ambil data dari form
  $id_petugas   = intval($_POST['id_petugas']);
  $username     = mysqli_real_escape_string($connect, $_POST['username']);
  $password     = mysqli_real_escape_string($connect, $_POST['password']);
  $nama_petugas = mysqli_real_escape_string($connect, $_POST['nama_petugas']);
  $id_level     = intval($_POST['id_level']);

  // Validasi data wajib
  if (empty($username) || empty($password) || empty($nama_petugas) || empty($id_level)) {
    echo "<script>
            alert('Semua field harus diisi!');
            window.history.back();
          </script>";
    exit;
  }

  // Cek apakah username sudah digunakan
  $checkUsername = mysqli_query($connect, "SELECT username FROM petugas WHERE username = '$username'");
  if (mysqli_num_rows($checkUsername) > 0) {
    echo "<script>
            alert('Username sudah digunakan, silakan pilih username lain!');
            window.history.back();
          </script>";
    exit;
  }

  // Enkripsi password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Simpan ke database
  $query = "
    INSERT INTO petugas (id_petugas, username, password, nama_petugas, id_level)
    VALUES ('$id_petugas', '$username', '$hashedPassword', '$nama_petugas', '$id_level')
  ";

  if (mysqli_query($connect, $query)) {
    echo "<script>
            alert('Data operator berhasil ditambahkan!');
            window.location.href='../../pages/operator/index.php';
          </script>";
  } else {
    echo "<script>
            alert('Gagal menambahkan operator: " . mysqli_error($connect) . "');
            window.history.back();
          </script>";
  }

} else {
  echo "<script>
          alert('Akses tidak diizinkan!');
          window.history.back();
        </script>";
}
?>
