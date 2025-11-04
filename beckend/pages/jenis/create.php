<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// --- Ambil ID terakhir ---
$qLastId = mysqli_query($connect, "SELECT id_jenis, kode_jenis FROM jenis ORDER BY id_jenis DESC LIMIT 1");
$dataLast = mysqli_fetch_assoc($qLastId);

// Jika ada data sebelumnya
if ($dataLast) {
  $nextId = $dataLast['id_jenis'] + 1;

  // Ambil angka dari kode terakhir, misal: JNS005 → 5
  $lastNumber = (int)substr($dataLast['kode_jenis'], 3);
  $nextNumber = $lastNumber + 1;
} else {
  // Jika tabel masih kosong
  $nextId = 1;
  $nextNumber = 1;
}

// Bentuk kode baru
$kode_jenis = 'JNS' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Header Section -->
    <div class="page-header">
      <h4 class="page-title">
        <i class="bi bi-plus-circle me-2 text-purple"></i>
        Tambah Jenis Barang
      </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.php">Data Jenis Barang</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Barang</li>
        </ol>
      </nav>
    </div>

    <!-- Form Tambah Jenis Barang -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <div class="d-flex align-items-center">
              <div class="card-icon bg-purple rounded-circle me-3">
                <i class="bi bi-plus-lg text-white"></i>
              </div>
              <div>
                <h5 class="card-title mb-0 fw-bold text-dark">Form Tambah Jenis Barang</h5>
                <p class="text-muted mb-0">Isi data berikut untuk menambahkan jenis barang baru</p>
              </div>
            </div>
          </div>

          <div class="card-body px-4 py-4">
            <!-- PERBAIKAN: Tambahkan enctype untuk upload file -->
            <form action="../../action/jenis/store.php" method="POST" enctype="multipart/form-data">

              <!-- ID Jenis (otomatis) -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-hash me-2 text-purple"></i>
                  ID Jenis Barang
                </label>
                <input type="text" name="id_jenis" 
                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                       value="<?= $nextId ?>" readonly
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> ID akan terisi otomatis
                </div>
              </div>

              <!-- Nama Jenis Barang -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-tag me-2 text-purple"></i>
                  Nama Jenis Barang <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama_jenis" 
                       class="form-control form-control-lg border-0 shadow-sm" 
                       placeholder="Masukkan nama jenis barang"
                       style="background: #f8f9fa; border-radius: 10px;" required>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Masukkan nama kategori jenis barang
                </div>
              </div>

              <!-- Kode Jenis (otomatis) -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-qr-code me-2 text-purple"></i>
                  Kode Jenis Barang
                </label>
                <input type="text" name="kode_jenis" 
                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                       value="<?= $kode_jenis ?>" readonly
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Kode akan terisi otomatis
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
                          rows="4" placeholder="Masukkan keterangan tambahan"
                          style="background: #f8f9fa; border-radius: 10px;"></textarea>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Tambahkan keterangan jika diperlukan
                </div>
              </div>

              <!-- Gambar Barang -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-image me-2 text-purple"></i> Gambar Barang
                </label>
                <!-- PERBAIKAN: Tambahkan accept yang benar dan required jika perlu -->
                <input type="file" name="image" 
                       class="form-control form-control-lg border-0 shadow-sm"
                       accept="image/*" 
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, GIF (Maks. 2MB)
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
                  <button type="submit" name="tombol" class="btn btn-purple-gradient px-4 py-2 rounded-pill shadow">
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