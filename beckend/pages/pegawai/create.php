<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// --- Ambil ID terakhir ---
$qLastId = mysqli_query($connect, "SELECT id_pegawai, nip FROM pegawai ORDER BY id_pegawai DESC LIMIT 1");
$dataLast = mysqli_fetch_assoc($qLastId);

// Jika ada data sebelumnya
if ($dataLast) {
  $nextId = $dataLast['id_pegawai'] + 1;

  // Ambil angka dari NIP terakhir, misal: PGW005 → 5
  $lastNumber = (int)substr($dataLast['nip'], 3);
  $nextNumber = $lastNumber + 1;
} else {
  // Jika tabel masih kosong
  $nextId = 1;
  $nextNumber = 1;
}

// Bentuk NIP baru
$kodePegawai = 'PGW' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Header Section -->
    <div class="page-header">
      <h4 class="page-title">
        <i class="bi bi-person-plus-fill me-2 text-purple"></i>
        Tambah Pegawai
      </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.php">Data Pegawai</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Pegawai</li>
        </ol>
      </nav>
    </div>

    <!-- Form Tambah Pegawai -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <div class="d-flex align-items-center">
              <div class="card-icon bg-purple rounded-circle me-3">
                <i class="bi bi-person-plus text-white"></i>
              </div>
              <div>
                <h5 class="card-title mb-0 fw-bold text-dark">Form Tambah Pegawai</h5>
                <p class="text-muted mb-0">Isi data berikut untuk menambahkan pegawai baru</p>
              </div>
            </div>
          </div>

          <div class="card-body px-4 py-4">
            <form action="../../action/pegawai/store.php" method="POST">

              <!-- ID Pegawai (otomatis) -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-hash me-2 text-purple"></i>
                  ID Pegawai
                </label>
                <input type="text" name="id_pegawai" 
                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                       value="<?= $nextId ?>" readonly
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> ID akan terisi otomatis
                </div>
              </div>

              <!-- Nama Pegawai -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-person-badge me-2 text-purple"></i>
                  Nama <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama_pegawai" 
                       class="form-control form-control-lg border-0 shadow-sm" 
                       placeholder="Masukkan nama "
                       style="background: #f8f9fa; border-radius: 10px;" required>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Masukkan nama lengkap 
                </div>
              </div>

              <!-- NIP (otomatis) -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-credit-card-2-front me-2 text-purple"></i>
                  NIP
                </label>
                <input type="text" name="nip" 
                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                       value="<?= $kodePegawai ?>" readonly
                       style="background: #f8f9fa; border-radius: 10px;">
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> NIP akan terisi otomatis
                </div>
              </div>

              <!-- Alamat -->
              <div class="mb-4">
                <label class="form-label fw-semibold text-dark">
                  <i class="bi bi-geo-alt-fill me-2 text-purple"></i>
                  Alamat
                </label>
                <textarea name="alamat" 
                          class="form-control form-control-lg border-0 shadow-sm" 
                          rows="4" placeholder="Masukkan alamat lengkap pegawai"
                          style="background: #f8f9fa; border-radius: 10px;" required></textarea>
                <div class="form-text text-muted">
                  <i class="bi bi-info-circle me-1"></i> Masukkan alamat domisili pegawai
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
  
  .btn-outline-secondary,
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
  
  .card-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #2600ffff, #0059ffff);
  }
  
  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(25, 0, 255, 1);
    border-color: #002fffff;
    background: #fff;
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
  }
</style>

<?php
include '../../partials/footer.php';
?>
