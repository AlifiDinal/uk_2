<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada parameter id_inventaris
if (!isset($_GET['id_inventaris'])) {
    echo "<script>alert('ID Inventaris tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}

$id_inventaris = intval($_GET['id_inventaris']);

// Ambil data inventaris dengan join ke tabel related
$query = "
    SELECT i.*, 
           j.nama_jenis AS nama_jenis, 
           r.nama_ruang AS nama_ruang,
           p.id_petugas AS id_petugas
    FROM inventaris i
    LEFT JOIN jenis j ON i.id_jenis = j.id_jenis
    LEFT JOIN ruang r ON i.id_ruang = r.id_ruang
    LEFT JOIN petugas p ON i.id_petugas = p.id_petugas
    WHERE i.id_inventaris = $id_inventaris
";
$result = mysqli_query($connect, $query);
$inventaris = mysqli_fetch_assoc($result);

if (!$inventaris) {
    echo "<script>alert('Data inventaris tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}

// Cek role session (sesuaikan dengan kebutuhan auth Anda)
// if (in_array($_SESSION['role'], ['admin', 'operator'])):
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-info-circle text-primary text-purple me-2"></i>Detail Pengembalian
      </h2>
      <h5 class="text-muted">Informasi lengkap data Pengembalian</h5>
    </div>

    <!-- Card Detail -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <h5 class="mb-0 fw-bold text-dark">
              <i class="bi bi-box-seam me-2"></i>Informasi Barang Pengembalian
            </h5>
          </div>
          <div class="card-body px-4 py-4">

            <table class="table table-bordered">
              <tr>
                <th width="30%" class="bg-light">Kode Pengembalian</th>
                <td>
                  <span class="badge bg-purple fs-6"><?= htmlspecialchars($inventaris['kode_inventaris']) ?></span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Nama</th>
                <td><?= htmlspecialchars($inventaris['nama']) ?></td>
              </tr>
              <tr>
                <th class="bg-light">Kondisi</th>
                <td>
                  <?php 
                  $badge_class = '';
                  switch($inventaris['kondisi']) {
                    case 'Baik':
                      $badge_class = 'bg-success';
                      break;
                    case 'Rusak Ringan':
                      $badge_class = 'bg-warning';
                      break;
                    case 'Rusak Berat':
                      $badge_class = 'bg-danger';
                      break;
                    default:
                      $badge_class = 'bg-secondary';
                  }
                  ?>
                  <span class="badge <?= $badge_class ?>"><?= htmlspecialchars($inventaris['kondisi']) ?></span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Keterangan</th>
                <td>
                  <?php if (!empty($inventaris['keterangan'])): ?>
                    <?= htmlspecialchars($inventaris['keterangan']) ?>
                  <?php else: ?>
                    <span class="text-muted">- Tidak ada keterangan -</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Jumlah</th>
                <td>
                  <span class="fw-bold text-primary fs-5"><?= number_format($inventaris['jumlah'], 0, ',', '.') ?></span> unit
                </td>
              </tr>
              <tr>
                <th class="bg-light">Tanggal Register</th>
                <td>
                  <i class="bi bi-calendar-event me-2 text-purple"></i>
                  <?= date('d M Y', strtotime($inventaris['tanggal_register'])) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Jenis Barang</th>
                <td>
                  <i class="bi bi-tags me-2 text-purple"></i>
                  <?= htmlspecialchars($inventaris['nama_jenis']) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Ruang</th>
                <td>
                  <i class="bi bi-building me-2 text-purple"></i>
                  <?= htmlspecialchars($inventaris['nama_ruang']) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Petugas</th>
                <td>
                  <i class="bi bi-person-gear me-2 text-purple"></i>
                  Petugas #<?= htmlspecialchars($inventaris['id_petugas']) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Status</th>
                <td>
                  <?php if ($inventaris['jumlah'] > 0): ?>
                    <span class="badge bg-success">
                      <i class="bi bi-check-circle me-1"></i>Tersedia
                    </span>
                  <?php else: ?>
                    <span class="badge bg-danger">
                      <i class="bi bi-x-circle me-1"></i>Habis
                    </span>
                  <?php endif; ?>
                </td>
              </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
              </a>
              <div>
                <a href="edit.php?id_inventaris=<?= $inventaris['id_inventaris'] ?>" class="btn btn-purple px-4 me-2">
                  <i class="bi bi-pencil-square me-2"></i>Edit Data
                </a>
                <a href="action/inventaris/destroy.php?id_inventaris=<?= $inventaris['id_inventaris'] ?>" 
                   class="btn btn-danger px-4"
                   onclick="return confirm('Yakin ingin menghapus data inventaris ini?')">
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

<?php 
// else: 
//   echo "<script>alert('Tidak dapat mengakses halaman ini');window.location.href='index.php';</script>";
// endif; 
?>

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
// include '../../partials/script.php'; // Sesuaikan dengan file script Anda
?>