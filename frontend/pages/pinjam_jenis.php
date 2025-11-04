<?php
session_start();
include __DIR__ . '/../../config/conection.php';

// Cek apakah pegawai sudah login
if (!isset($_SESSION['id_pegawai'])) {
  echo "
  <script>
    alert('Anda harus login terlebih dahulu untuk meminjam barang!');
    window.location.href='../pages/masuk.php';
  </script>";
  exit;
}

// Ambil data pegawai dari session
$namaPegawai = $_SESSION['nama_pegawai'] ?? 'Pegawai';
$idPegawai = $_SESSION['id_pegawai'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tambah Data Peminjaman</title>

  <!-- Favicons -->
  <link href="../templates_users/assets/img/logo_smk.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../templates_users/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../templates_users/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../templates_users/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../templates_users/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../templates_users/assets/css/main.css" rel="stylesheet">
  
 <style>
  .form-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 20px;
  }

  .form-header {
    border-bottom: 1px solid #eeeeeeff;
    padding-bottom: 15px;
    margin-bottom: 25px;
  }

  .form-label {
    font-weight: 500;
    margin-bottom: 8px;
  }

  /* Tombol simpan */
  .btn-submit {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff !important;
    padding: 10px 25px;
    font-weight: 500;
    transition: all 0.2s ease;
  }

  .btn-submit:hover {
    background-color: #0b5ed7;
    border-color: #0b5ed7;
    color: #fff !important;
  }

  .btn-submit:active,
  .btn-submit:focus {
    background-color: #0a58ca !important;
    border-color: #0a58ca !important;
    color: #fff !important;
    box-shadow: none !important;
  }

  /* Tombol batal */
  .btn-cancel {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff !important;
    padding: 10px 25px;
    font-weight: 500;
    transition: all 0.2s ease;
  }

  .btn-cancel:hover {
    background-color: #5c636a;
    border-color: #565e64;
  }

  .btn-cancel:active,
  .btn-cancel:focus {
    background-color: #4e555b !important;
    border-color: #4e555b !important;
    color: #fff !important;
    box-shadow: none !important;
  }
</style>

</head>

<body class="d-flex flex-column min-vh-100">

  <main class="flex-grow-1">
    <section class="py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="form-container" data-aos="fade-up">
                <div class="form-header">
                  <h2 class="fw-bold text-dark mb-2">Tambah Data Peminjaman</h2>
                  <p class="text-muted">Isi form berikut untuk menambahkan data peminjaman baru</p>
                </div>
                
                <form action="../action/pinjam_jenis.php" method="POST">
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
                      </div>
                      <div class="col-md-6">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="status_peminjaman" class="form-label">Status Peminjaman</label>
                      <select class="form-select" id="status_peminjaman" name="status_peminjaman" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                      </select>
                    </div>

                    <!-- Nama Pegawai tampil, tapi tidak bisa diubah -->
                    <div class="mb-3">
                      <label class="form-label">Nama</label>
                      <input type="text" class="form-control" value="<?= htmlspecialchars($namaPegawai) ?>" readonly>
                    </div>

                    <!-- ID Pegawai otomatis dikirim -->
                    <input type="hidden" name="id_pegawai" value="<?= htmlspecialchars($idPegawai) ?>">

                    <div class="d-flex justify-content-end gap-2 mt-4">
                      <a href="../index.php" class="btn btn-cancel">Batal</a>
                      <button type="submit" name="tombol" class="btn btn-submit">Simpan Data</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
      <p class="mb-0">&copy; <?= date('Y') ?> Inventaris App. All rights reserved.</p>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="../templates_users/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../templates_users/assets/vendor/aos/aos.js"></script>

  <script>
    AOS.init();
  </script>
</body>
</html>
