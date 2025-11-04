<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada ID di URL
if (!isset($_GET['id_petugas']) || empty($_GET['id_petugas'])) {
    echo "
        <script>
            alert('ID petugas tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

$id_petugas = intval($_GET['id_petugas']);

// Ambil data petugas - GUNAKAN PREFIX
$qpetugas = mysqli_query($connect, "SELECT * FROM petugas WHERE id_petugas = $id_petugas");
$petugas = mysqli_fetch_assoc($qpetugas);

if (!$petugas) {
    echo "
        <script>
            alert('Data petugas tidak ditemukan!');
            window.location.href = './index.php';
        </script>
    ";
    exit;
}

// Ambil data dropdown level - GUNAKAN PREFIX dan PERBAIKI VARIABLE
$qlevel = mysqli_query($connect, "SELECT * FROM level ORDER BY nama_level ASC");
?>

<div class="container-fluid">
    <div class="page-inner">

        <!-- Header Section -->
        <div class="page-header">
            <h4 class="page-title">
                <i class="bi bi-person-gear me-2 text-purple"></i>
                Edit Petugas
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Data Petugas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Petugas</li>
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
                                <h4 class="card-title mb-0 fw-bold text-dark">Edit Data Petugas</h4>
                                <p class="text-muted mb-0">Perbarui informasi petugas yang ada</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../action/operator/update.php?id_petugas=<?= $petugas['id_petugas'] ?>" method="POST">
                            
                            <!-- Username -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-person-badge me-2 text-purple"></i>
                                    Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($petugas['username']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Username untuk login petugas
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-key me-2 text-purple"></i>
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($petugas['password']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Password untuk login petugas
                                </div>
                            </div>

                            <!-- Nama Petugas -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-person me-2 text-purple"></i>
                                    Nama Petugas <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_petugas" class="form-control form-control-lg border-0 shadow-sm" 
                                       value="<?= htmlspecialchars($petugas['nama_petugas']) ?>" required
                                       style="background: #f8f9fa; border-radius: 10px;">
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Nama lengkap petugas
                                </div>
                            </div>

                            <!-- Level -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-shield-check me-2 text-purple"></i>
                                    Level <span class="text-danger">*</span>
                                </label>
                                <select name="id_level" class="form-select form-control-lg border-0 shadow-sm" required
                                        style="background: #f8f9fa; border-radius: 10px;">
                                    <option value="">-- Pilih Level --</option>
                                    <?php while ($lvl = mysqli_fetch_assoc($qlevel)): ?>
                                        <option value="<?= $lvl['id_level'] ?>" 
                                            <?= ($petugas['id_level'] == $lvl['id_level']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($lvl['nama_level']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="form-text text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pilih level akses petugas
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