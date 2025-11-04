<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_jenis']) || empty($_GET['id_jenis'])) {
    echo "
        <script>
            alert('ID jenis tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

$id_jenis = intval($_GET['id_jenis']);

// Ambil data jenis pakai prepared statement
$stmt = mysqli_prepare($connect, "SELECT * FROM jenis WHERE id_jenis = ?");
mysqli_stmt_bind_param($stmt, "i", $id_jenis);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$jenis = mysqli_fetch_assoc($result);

if (!$jenis) {
    echo "
        <script>
            alert('Data jenis tidak ditemukan!');
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
                <i class="bi bi-pencil-square me-2 text-purple"></i>
                Edit Jenis Barang
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Data Jenis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jenis</li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white border-0 rounded-top-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-purple rounded-circle me-3">
                                <i class="bi bi-pencil-square text-white"></i>
                            </div>
                            <div>
                                <h4 class="card-title mb-0 fw-bold text-dark">Edit Data Jenis Barang</h4>
                                <p class="text-muted mb-0">Perbarui informasi jenis barang yang ada</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 py-4">
                        <form action="../../action/jenis/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_jenis" value="<?= htmlspecialchars($jenis['id_jenis']) ?>">
                            <input type="hidden" name="old_image" value="<?= htmlspecialchars($jenis['image'] ?? '') ?>">

                            <!-- Nama Jenis -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-tag me-2 text-purple"></i>
                                    Nama Jenis Barang <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_jenis" 
                                       class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($jenis['nama_jenis'] ?? '') ?>" 
                                       placeholder="Masukkan nama jenis barang"
                                       style="background: #f8f9fa; border-radius: 10px;" 
                                       required>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Ubah nama jenis barang
                                </div>
                            </div>

                            <!-- Kode Jenis -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-qr-code me-2 text-purple"></i>
                                    Kode Jenis
                                </label>
                                <input type="text" name="kode_jenis" 
                                       class="form-control form-control-lg border-0 shadow-sm fw-bold text-primary" 
                                       value="<?= htmlspecialchars($jenis['kode_jenis'] ?? '') ?>" 
                                       readonly
                                       style="background: #e9ecef; border-radius: 10px; cursor: not-allowed;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-lock me-1"></i> Kode jenis tidak dapat diubah
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
                                          rows="4" 
                                          placeholder="Masukkan keterangan tambahan"
                                          style="background: #f8f9fa; border-radius: 10px;"><?= htmlspecialchars($jenis['keterangan'] ?? '') ?></textarea>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Ubah keterangan jenis barang
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-image me-2 text-purple"></i>
                                    Gambar Barang
                                </label><br>
                                
                                <?php 
                                $imagePath = "../../../storages/jenis/" . ($jenis['image'] ?? '');
                                $imageExists = (!empty($jenis['image']) && file_exists($imagePath));
                                ?>
                                
                                <?php if ($imageExists): ?>
                                    <div class="mb-3">
                                        <p class="text-muted mb-2">Gambar saat ini:</p>
                                        <img id="previewImage" 
                                             src="<?= $imagePath ?>?t=<?= time(); ?>" 
                                             alt="Gambar <?= htmlspecialchars($jenis['nama_jenis'] ?? '') ?>" 
                                             class="img-fluid rounded shadow-sm border" 
                                             style="max-height: 150px; object-fit: cover;">
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-light border mb-3">
                                        <i class="bi bi-image text-muted me-2"></i>
                                        <span class="text-muted">Tidak ada gambar saat ini.</span>
                                    </div>
                                    <img id="previewImage" class="img-fluid rounded shadow-sm border d-none" style="max-height: 150px; object-fit: cover;">
                                <?php endif; ?>
                                
                                <label class="form-label text-muted mt-3">Ubah gambar:</label>
                                <input type="file" name="image" id="imageInput"
                                       class="form-control form-control-lg border-0 shadow-sm"
                                       accept="image/*"
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Kosongkan jika tidak ingin mengubah gambar
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="index.php" class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                <div class="d-flex gap-2">
                                    <a href="index.php" class="btn btn-light px-4 py-2 rounded-pill">
                                        <i class="bi bi-x-circle me-2"></i> Batal
                                    </a>
                                    <button type="submit" name="tombol" class="btn btn-purple-gradient px-4 py-2 rounded-pill shadow">
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

<!-- Preview Gambar Baru -->
<script>
document.getElementById('imageInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const preview = document.getElementById('previewImage');
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    }
});
</script>

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
    .btn-outline-secondary, .btn-light {
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
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(25, 0, 255, 1);
        border-color: #002fffff;
        background: #fff;
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
    }
</style>

<?php
include '../../partials/footer.php';
?>
