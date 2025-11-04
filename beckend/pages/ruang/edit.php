<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_ruang']) || empty($_GET['id_ruang'])) {
    echo "
        <script>
            alert('ID ruang tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

$id_ruang = intval($_GET['id_ruang']);

// Ambil data ruang - GUNAKAN PREFIX
$qruang = mysqli_query($connect, "SELECT * FROM ruang WHERE id_ruang = $id_ruang");
$ruang = mysqli_fetch_assoc($qruang);

if (!$ruang) {
    echo "
        <script>
            alert('Data ruang tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}
?>

<div class="container-fluid">
    <div class="page-inner">

        <!-- Header Section -->
        <div class="page-header">
            <h4 class="page-title">
                <i class="bi bi-building me-2 text-purple"></i>
                Edit Ruang
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Data Ruang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Ruang</li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-purple rounded-circle me-3">
                                <i class="bi bi-pencil-square text-white"></i>
                            </div>
                            <div>
                                <h4 class="card-title mb-0 fw-bold text-dark">Edit Data Ruang</h4>
                                <p class="text-muted mb-0">Perbarui informasi ruang yang ada</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/ruang/update.php?id_ruang=<?= $ruang['id_ruang'] ?>" method="POST">
                            
                            <!-- Nama Ruang -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-building me-2 text-purple"></i>
                                    Nama Ruang <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_ruang" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($ruang['nama_ruang']) ?>" 
                                       placeholder="Masukkan nama ruang" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Contoh: Lab Komputer, Ruang Kelas, Perpustakaan
                                </div>
                            </div>

                            <!-- Kode Ruang -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-code me-2 text-purple"></i>
                                    Kode Ruang <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="kode_ruang" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($ruang['kode_ruang']) ?>" 
                                       placeholder="Masukkan kode ruang" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Gunakan huruf/angka singkat (contoh: LK01, RK12)
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-text-paragraph me-2 text-purple"></i>
                                    Keterangan
                                </label>
                                <textarea name="keterangan" class="form-control border-0 shadow-sm" rows="4" 
                                          placeholder="Masukkan keterangan tambahan tentang ruang ini"
                                          style="background: #f8f9fa; border-radius: 10px; resize: none;"><?= htmlspecialchars($ruang['keterangan']) ?></textarea>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Informasi tambahan seperti fasilitas, kapasitas, atau kondisi ruang
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
                                        <i class="bi bi-save me-2"></i> Simpan Perubahan
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

<style>
    .btn-purple {
        background: linear-gradient(135deg, #0004ffff, #006effff);
        color: #fff;
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-purple-gradient {
        background: linear-gradient(135deg, #003cffff, #0004ffff);
        color: #fff;
        border: none;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .btn-purple-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(45, 41, 255, 0.78) !important;
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
        background: linear-gradient(135deg, #1100ffff, #006effff);
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(4, 0, 255, 1);
        border-color: #3354e7ff;
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
        color: #0400ffff;
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