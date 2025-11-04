<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada parameter id_petugas
if (!isset($_GET['id_petugas'])) {
    echo "<script>alert('ID Petugas tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}

$id_petugas = intval($_GET['id_petugas']);

// Ambil data petugas dengan join ke tabel level
$query = "
    SELECT p.*, 
           l.nama_level AS nama_level
    FROM petugas p
    LEFT JOIN level l ON p.id_level = l.id_level
    WHERE p.id_petugas = $id_petugas
";
$result = mysqli_query($connect, $query);
$petugas = mysqli_fetch_assoc($result);

if (!$petugas) {
    echo "<script>alert('Data petugas tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-person-badge text-primary text-purple me-2"></i>Detail Petugas
      </h2>
      <h5 class="text-muted">Informasi lengkap data petugas</h5>
    </div>

    <!-- Card Detail -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <h5 class="mb-0 fw-bold text-dark">
              <i class="bi bi-person-lines-fill me-2"></i>Informasi Petugas
            </h5>
          </div>
          <div class="card-body px-4 py-4">

            <table class="table table-bordered">
              <tr>
                <th width="30%" class="bg-light">ID Petugas</th>
                <td>
                  <span class="badge bg-purple fs-6">#<?= htmlspecialchars($petugas['id_petugas']) ?></span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Username</th>
                <td>
                  <i class="bi bi-person-circle me-2 text-purple"></i>
                  <?= htmlspecialchars($petugas['username']) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Nama Petugas</th>
                <td>
                  <i class="bi bi-person-vcard me-2 text-purple"></i>
                  <?= htmlspecialchars($petugas['nama_petugas']) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Level</th>
                <td>
                  <?php 
                  $badge_class = '';
                  switch($petugas['id_level']) {
                    case 1:
                      $badge_class = 'bg-primary';
                      break;
                    case 2:
                      $badge_class = 'bg-success';
                      break;
                    case 3:
                      $badge_class = 'bg-info';
                      break;
                    default:
                      $badge_class = 'bg-secondary';
                  }
                  ?>
                  <span class="badge <?= $badge_class ?>">
                    <?= htmlspecialchars($petugas['nama_level'] ?? 'Level #' . $petugas['id_level']) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Status Akun</th>
                <td>
                  <span class="badge bg-success">
                    <i class="bi bi-check-circle me-1"></i>Aktif
                  </span>
                </td>
              </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
              </a>
              <div>
                <a href="edit.php?id_petugas=<?= $petugas['id_petugas'] ?>" class="btn btn-purple px-4 me-2">
                  <i class="bi bi-pencil-square me-2"></i>Edit Data
                </a>
                <a href="action/petugas/destroy.php?id_petugas=<?= $petugas['id_petugas'] ?>" 
                   class="btn btn-danger px-4"
                   onclick="return confirm('Yakin ingin menghapus data petugas ini?')">
                  <i class="bi bi-trash me-2"></i>Hapus
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .btn-purple {
    background-color: #011affff;
    color: #fff;
    border-radius: 8px;
    transition: 0.2s ease-in-out;
  } 
  .btn-purple:hover {
    background-color: #006effff;
    color: #fff;
  }
  .bg-purple {
    background-color: #0084ffff !important;
  }
  .table th {
    font-weight: 600;
  }
</style>

<?php
include '../../partials/footer.php';
?>