<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Ambil data untuk dropdown
$qJenis = mysqli_query($connect, "SELECT * FROM jenis ORDER BY nama_jenis ASC");
$qRuang = mysqli_query($connect, "SELECT * FROM ruang ORDER BY nama_ruang ASC");
$qPetugas = mysqli_query($connect, "SELECT * FROM petugas ORDER BY nama_petugas ASC");

// Buat kode inventaris otomatis
$getKode = mysqli_query($connect, "SELECT MAX(kode_inventaris) AS kode_terakhir FROM inventaris");
$dataKode = mysqli_fetch_assoc($getKode);
$kodeBaru = "INV-0001";
if ($dataKode && $dataKode['kode_terakhir']) {
    $lastNum = intval(substr($dataKode['kode_terakhir'], 4));
    $kodeBaru = "INV-" . str_pad($lastNum + 1, 4, "0", STR_PAD_LEFT);
}

// Simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $kondisi = mysqli_real_escape_string($connect, $_POST['kondisi']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $jumlah = intval($_POST['jumlah']);
    $id_jenis = intval($_POST['id_jenis']);
    $id_ruang = intval($_POST['id_ruang']);
    $id_petugas = intval($_POST['id_petugas']);
    $tanggal_register = date('Y-m-d');
    $kode_inventaris = mysqli_real_escape_string($connect, $_POST['kode_inventaris']);

    $insert = mysqli_query($connect, "
        INSERT INTO inventaris 
        (nama, kondisi, keterangan, jumlah, id_jenis, tanggal_register, id_ruang, kode_inventaris, id_petugas)
        VALUES 
        ('$nama', '$kondisi', '$keterangan', '$jumlah', '$id_jenis', '$tanggal_register', '$id_ruang', '$kode_inventaris', '$id_petugas')
    ");

    if ($insert) {
        echo "
            <script>
                alert('Data inventaris berhasil ditambahkan!');
                window.location.href = './index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data: " . mysqli_error($connect) . "');
            </script>
        ";
    }
}
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Header Section -->
    <div class="page-header">
      <h4 class="page-title">
        <i class="bi bi-plus-circle me-2 text-purple"></i>
        Tambah Pengembalian
      </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.php">Data Inventaris</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Pengembalian</li>
        </ol>
      </nav>
    </div>

    <!-- Form Tambah Inventaris -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <div class="d-flex align-items-center">
              <div class="card-icon bg-purple rounded-circle me-3">
                <i class="bi bi-plus-lg text-white"></i>
              </div>
              <div>
                <h5 class="card-title mb-0 fw-bold text-dark">Form Tambah Pengembalian</h5>
                <p class="text-muted mb-0">Isi data berikut untuk menambahkan Pengembalian baru</p>
              </div>
            </div>
          </div>

          <div class="card-body px-4 py-4">
            <form method="POST">

              <!-- Kode Inventaris -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-qr-code me-2 text-purple"></i>
                  Kode Pengembalian
                </label>
                <input type="text" name="kode_inventaris" 
                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                       value="<?= $kodeBaru ?>" readonly
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Kode Pengembalian akan terisi otomatis
                </div>
              </div>

              <!-- Nama Barang -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-tag me-2 text-purple"></i>
                  Nama <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama" 
                       class="form-control form-control-lg border-0 shadow-sm" 
                       placeholder="Masukkan nama barang"
                       style="background: #f8f9fa; border-radius: 10px;" required>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Masukkan nama Pengembali
                </div>
              </div>

              <!-- Kondisi -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-clipboard-check me-2 text-purple"></i>
                  Kondisi <span class="text-danger">*</span>
                </label>
                <select name="kondisi" 
                        class="form-select form-control-lg border-0 shadow-sm" 
                        style="background: #f8f9fa; border-radius: 10px;" required>
                  <option value="">-- Pilih Kondisi --</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak Ringan">Rusak Ringan</option>
                  <option value="Rusak Berat">Rusak Berat</option>
                </select>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Pilih kondisi barang saat ini
                </div>
              </div>

              <!-- Keterangan -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-text-paragraph me-2 text-purple"></i>
                  Keterangan
                </label>
                <textarea name="keterangan" 
                          class="form-control form-control-lg border-0 shadow-sm" 
                          rows="3" placeholder="Masukkan keterangan tambahan"
                          style="background: #f8f9fa; border-radius: 10px;"></textarea>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Tambahkan keterangan jika diperlukan
                </div>
              </div>

              <!-- Jumlah -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-123 me-2 text-purple"></i>
                  Jumlah <span class="text-danger">*</span>
                </label>
                <input type="number" name="jumlah" 
                       class="form-control form-control-lg border-0 shadow-sm" 
                       min="1" max="1000"
                       style="background: #f8f9fa; border-radius: 10px;" required>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Masukkan jumlah barang yang tersedia
                </div>
              </div>

              <!-- Jenis Barang -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-grid me-2 text-purple"></i>
                  Jenis Barang <span class="text-danger">*</span>
                </label>
                <select name="id_jenis" 
                        class="form-select form-control-lg border-0 shadow-sm" 
                        style="background: #f8f9fa; border-radius: 10px;" required>
                  <option value="">-- Pilih Jenis Barang --</option>
                  <?php while ($j = mysqli_fetch_assoc($qJenis)): ?>
                    <option value="<?= $j['id_jenis'] ?>">
                      <?= htmlspecialchars($j['nama_jenis']) ?>
                    </option>
                  <?php endwhile; ?>
                </select>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Pilih kategori jenis barang
                </div>
              </div>

              <!-- Ruang -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-door-closed me-2 text-purple"></i>
                  Ruang <span class="text-danger">*</span>
                </label>
                <select name="id_ruang" 
                        class="form-select form-control-lg border-0 shadow-sm" 
                        style="background: #f8f9fa; border-radius: 10px;" required>
                  <option value="">-- Pilih Ruang --</option>
                  <?php while ($r = mysqli_fetch_assoc($qRuang)): ?>
                    <option value="<?= $r['id_ruang'] ?>">
                      <?= htmlspecialchars($r['nama_ruang']) ?>
                    </option>
                  <?php endwhile; ?>
                </select>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Pilih lokasi penyimpanan barang
                </div>
              </div>

              <!-- Petugas -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-person-check me-2 text-purple"></i>
                  Petugas <span class="text-danger">*</span>
                </label>
                <select name="id_petugas" 
                        class="form-select form-control-lg border-0 shadow-sm" 
                        style="background: #f8f9fa; border-radius: 10px;" required>
                  <option value="">-- Pilih Petugas --</option>
                  <?php while ($p = mysqli_fetch_assoc($qPetugas)): ?>
                    <option value="<?= $p['id_petugas'] ?>">
                      <?= htmlspecialchars($p['nama_petugas']) ?>
                    </option>
                  <?php endwhile; ?>
                </select>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Pilih petugas yang bertanggung jawab
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                <a href="index.php" class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                  <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
                <div class="d-flex gap-2">
                  <a href="index.php" class="btn btn-light px-4 py-2 rounded-pill">
                    <i class="bi bi-x-circle me-2"></i> Batal
                  </a>
                  <button type="submit" class="btn btn-purple-gradient px-4 py-2 rounded-pill shadow">
                    <i class="bi bi-save me-2"></i> Simpan Data
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Styling -->
<style>
.btn-purple-gradient {
    background: linear-gradient(135deg, #001affff, rgba(0, 89, 255, 1));
    color: #fff;
    border: none;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-weight: 600;
  }
  
  .btn-purple-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(4, 0, 255, 0.71) !important;
    color: #fff;
  }
  
  .btn-outline-secondary {
    border-radius: 25px;
    transition: all 0.3s ease;
  }
  
  .btn-light {
    border-radius: 25px;
    transition: all 0.3s ease;
  }
  
  .card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .card-header {
    border-bottom: 2px solid #f8f9fa;
    padding: 1.5rem 2rem;
  }
  
  .card-body {
    padding: 2rem;
  }
  
  .card-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #2600ffff, #0059ffff);
  }
  
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(25, 0, 255, 1);
    border-color: #002fffff;
    background: #fff;
  }
  
  .form-label {
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
  }
  
  .breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 1rem;
  }
  
  .breadcrumb-item a {
    color: #0004ffff;
    text-decoration: none;
  }
  
  .breadcrumb-item.active {
    color: #6c757d;
  }
  
  .page-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }
</style>

<?php
include '../../partials/footer.php';
?>