<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada parameter id_peminjaman
if (!isset($_GET['id_peminjaman'])) {
    echo "<script>alert('ID Peminjaman tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}

$id_peminjaman = intval($_GET['id_peminjaman']);

// Ambil data peminjaman dengan join ke tabel related
$query = "
    SELECT p.*, 
           pg.nama_pegawai AS nama_pegawai
    FROM peminjaman p
    LEFT JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
    WHERE p.id_peminjaman = $id_peminjaman
";
$result = mysqli_query($connect, $query);
$peminjaman = mysqli_fetch_assoc($result);

if (!$peminjaman) {
    echo "<script>alert('Data peminjaman tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-info-circle text-primary text-purple me-2"></i>Detail Peminjaman
      </h2>
      <h5 class="text-muted">Informasi lengkap data peminjaman</h5>
    </div>

    <!-- Card Detail -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white border-0 rounded-top-4">
            <h5 class="mb-0 fw-bold text-dark">
              <i class="bi bi-clipboard-check me-2"></i>Informasi Peminjaman
            </h5>
          </div>
          <div class="card-body px-4 py-4">

            <table class="table table-bordered">
              <tr>
                <th width="30%" class="bg-light">ID Peminjaman</th>
                <td>
                  <span class="badge bg-purple fs-6">#<?= htmlspecialchars($peminjaman['id_peminjaman']) ?></span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Tanggal Pinjam</th>
                <td>
                  <i class="bi bi-calendar-event me-2 text-purple"></i>
                  <?= date('d M Y', strtotime($peminjaman['tanggal_pinjam'])) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Tanggal Kembali</th>
                <td>
                  <i class="bi bi-calendar-check me-2 text-purple"></i>
                  <?= date('d M Y', strtotime($peminjaman['tanggal_kembali'])) ?>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Status Peminjaman</th>
                <td>
                  <?php 
                  $badge_class = '';
                  switch($peminjaman['status_peminjaman']) {
                    case 'Dipinjam':
                      $badge_class = 'bg-warning';
                      break;
                    case 'Dikembalikan':
                      $badge_class = 'bg-success';
                      break;
                    default:
                      $badge_class = 'bg-secondary';
                  }
                  ?>
                  <span class="badge <?= $badge_class ?>">
                    <?= htmlspecialchars($peminjaman['status_peminjaman']) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Nama Peminjam</th>
                <td>
                  <i class="bi bi-person me-2 text-purple"></i>
                  <?= htmlspecialchars($peminjaman['nama_pegawai'] ?? 'Pegawai #' . $peminjaman['id_pegawai']) ?>
                </td>
              </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
              </a>
              <div>
                <a href="edit.php?id_peminjaman=<?= $peminjaman['id_peminjaman'] ?>" class="btn btn-purple px-4 me-2">
                  <i class="bi bi-pencil-square me-2"></i>Edit Data
                </a>
                <a href="action/peminjaman/destroy.php?id_peminjaman=<?= $peminjaman['id_peminjaman'] ?>" 
                   class="btn btn-danger px-4"
                   onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')">
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