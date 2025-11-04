<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_detail_pinjam']) || empty($_GET['id_detail_pinjam'])) {
    echo "
        <script>
            alert('ID detail_pinjam tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

$id_detail_pinjam = intval($_GET['id_detail_pinjam']);

// Ambil data detail_pinjam - GUNAKAN PREFIX dan PERBAIKI NAMA TABEL
$qdetail_pinjam = mysqli_query($connect, "SELECT * FROM detail_pinjam WHERE id_detail_pinjam = $id_detail_pinjam");
$detail_pinjam = mysqli_fetch_assoc($qdetail_pinjam);

if (!$detail_pinjam) {
    echo "
        <script>
            alert('Data detail_pinjam tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

// Ambil data dropdown - GUNAKAN PREFIX dan PERBAIKI NAMA TABEL
$qinventaris = mysqli_query($connect, "SELECT * FROM inventaris ORDER BY kode_inventaris ASC");
$qpeminjaman = mysqli_query($connect, "SELECT * FROM peminjaman ORDER BY id_peminjaman ASC");
?>

<div class="container-fluid">
    <div class="page-inner">

        <!-- Header Section -->
        <div class="page-header">
            <h4 class="page-title">
                <i class="bi bi-clipboard-check me-2 text-purple"></i>
                Edit Detail Peminjaman
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Data Detail Pinjam</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Detail Pinjam</li>
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
                                <h4 class="card-title mb-0 fw-bold text-dark">Edit Data Detail Peminjaman</h4>
                                <p class="text-muted mb-0">Perbarui informasi detail peminjaman yang ada</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/detail_pinjam/update.php?id_detail_pinjam=<?= $detail_pinjam['id_detail_pinjam'] ?>" method="POST">

                            <!-- Inventaris -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-box me-2 text-purple"></i>
                                    Kode Pengembalian <span class="text-danger">*</span>
                                </label>
                                <select name="id_inventaris" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Kode Pengembalian --</option>
                                    <?php while ($inv = mysqli_fetch_assoc($qinventaris)): ?>
                                        <option value="<?= $inv['id_inventaris'] ?>" 
                                            <?= ($detail_pinjam['id_inventaris'] == $inv['id_inventaris']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($inv['kode_inventaris']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih Kode Pengembalian
                                </div>
                            </div>

                            <!-- Peminjaman -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-clipboard-check me-2 text-purple"></i>
                                    Data Peminjaman <span class="text-danger">*</span>
                                </label>
                                <select name="id_peminjaman" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Peminjaman --</option>
                                    <?php while ($pjm = mysqli_fetch_assoc($qpeminjaman)): ?>
                                        <option value="<?= $pjm['id_peminjaman'] ?>" 
                                            <?= ($detail_pinjam['id_peminjaman'] == $pjm['id_peminjaman']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pjm['id_peminjaman']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih data peminjaman
                                </div>
                            </div>

                            <!-- Jumlah -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-123 me-2 text-purple"></i>
                                    Jumlah <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="jumlah" class="form-control form-control-lg border-0 shadow-sm" min="1" 
                                       value="<?= htmlspecialchars($detail_pinjam['jumlah']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Jumlah barang yang dipinjam
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