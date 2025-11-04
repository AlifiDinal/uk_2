<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_inventaris']) || empty($_GET['id_inventaris'])) {
    echo "
        <script>
            alert('ID inventaris tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

$id_inventaris = intval($_GET['id_inventaris']);

// Ambil data inventaris - GUNAKAN PREFIX
$qInventaris = mysqli_query($connect, "SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris");
$inventaris = mysqli_fetch_assoc($qInventaris);

if (!$inventaris) {
    echo "
        <script>
            alert('Data inventaris tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

// Ambil data dropdown - GUNAKAN PREFIX
$qJenis   = mysqli_query($connect, "SELECT * FROM jenis ORDER BY nama_jenis ASC");
$qRuang   = mysqli_query($connect, "SELECT * FROM ruang ORDER BY nama_ruang ASC");
$qPetugas = mysqli_query($connect, "SELECT * FROM petugas ORDER BY id_petugas ASC");
?>

<div class="container-fluid">
    <div class="page-inner">

        <!-- Header Section -->
        <div class="page-header">
            <h4 class="page-title">
                <i class="bi bi-box-seam me-2 text-purple"></i>
                Edit Pengembalian
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Data Pengembalian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pengembalian</li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-purple rounded-circle me-3">
                                <i class="bi bi-pencil-square text-white"></i>
                            </div>
                            <div>
                                <h4 class="card-title mb-0 fw-bold text-dark">Edit Data Pengembalian</h4>
                                <p class="text-muted mb-0">Perbarui informasi Pengembalian yang ada</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/inventaris/update.php?id_inventaris=<?= $inventaris['id_inventaris'] ?>" method="POST">
                            
                            <!-- Kode Pengembalian - TIDAK BISA DIEDIT -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-qr-code me-2 text-purple"></i>
                                    Kode Pengembalian
                                </label>
                                <input type="text" name="kode_inventaris" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($inventaris['kode_inventaris']) ?>" 
                                       readonly
                                       style="background: #e9ecef; border-radius: 10px; cursor: not-allowed;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-lock me-1"></i> Kode Pengembalian tidak dapat diubah
                                </div>
                            </div>

                            <!-- Nama Barang -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-box me-2 text-purple"></i>
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($inventaris['nama']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Masukkan nama inventaris
                                </div>
                            </div>

                            <!-- Kondisi -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-clipboard-check me-2 text-purple"></i>
                                    Kondisi <span class="text-danger">*</span>
                                </label>
                                <select name="kondisi" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baik" <?= ($inventaris['kondisi'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
                                    <option value="Rusak Ringan" <?= ($inventaris['kondisi'] == 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan</option>
                                    <option value="Rusak Berat" <?= ($inventaris['kondisi'] == 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat</option>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih kondisi barang saat ini
                                </div>
                            </div>

                            <!-- Jumlah -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-123 me-2 text-purple"></i>
                                    Jumlah <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="jumlah" class="form-control form-control-lg border-0 shadow-sm" min="1" 
                                       value="<?= htmlspecialchars($inventaris['jumlah']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Jumlah barang yang tersedia
                                </div>
                            </div>

                            <!-- Tanggal Register - TIDAK BISA DIEDIT -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-calendar-event me-2 text-purple"></i>
                                    Tanggal Register
                                </label>
                                <input type="date" name="tanggal_register" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($inventaris['tanggal_register']) ?>" 
                                       readonly
                                       style="background: #e9ecef; border-radius: 10px; cursor: not-allowed;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-lock me-1"></i> Tanggal register tidak dapat diubah
                                </div>
                            </div>

                            <!-- Jenis Barang -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-tags me-2 text-purple"></i>
                                    Jenis Barang <span class="text-danger">*</span>
                                </label>
                                <select name="id_jenis" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Jenis --</option>
                                    <?php while ($j = mysqli_fetch_assoc($qJenis)): ?>
                                        <option value="<?= $j['id_jenis'] ?>" 
                                            <?= ($inventaris['id_jenis'] == $j['id_jenis']) ? 'selected' : '' ?>>
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
                                    <i class="bi bi-building me-2 text-purple"></i>
                                    Ruang <span class="text-danger">*</span>
                                </label>
                                <select name="id_ruang" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Ruang --</option>
                                    <?php while ($r = mysqli_fetch_assoc($qRuang)): ?>
                                        <option value="<?= $r['id_ruang'] ?>" 
                                            <?= ($inventaris['id_ruang'] == $r['id_ruang']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($r['nama_ruang']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih lokasi ruang barang
                                </div>
                            </div>

                            <!-- Petugas -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-person-gear me-2 text-purple"></i>
                                    Petugas <span class="text-danger">*</span>
                                </label>
                                <select name="id_petugas" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Petugas --</option>
                                    <?php while ($p = mysqli_fetch_assoc($qPetugas)): ?>
                                        <option value="<?= $p['id_petugas'] ?>" 
                                            <?= ($inventaris['id_petugas'] == $p['id_petugas']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($p['id_petugas']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih petugas penanggung jawab
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-text-paragraph me-2 text-purple"></i>
                                    Keterangan
                                </label>
                                <textarea name="keterangan" class="form-control border-0 shadow-sm" rows="4" 
                                          placeholder="Masukkan keterangan tambahan tentang barang ini"
                                          style="background: #f8f9fa; border-radius: 10px; resize: none;"><?= htmlspecialchars($inventaris['keterangan']) ?></textarea>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Informasi tambahan seperti spesifikasi, merk, atau catatan khusus
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