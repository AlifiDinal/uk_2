<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan ada parameter id_jenis
if (!isset($_GET['id_jenis'])) {
    echo "<script>alert('ID Jenis tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}

$id_jenis = intval($_GET['id_jenis']);

// Ambil data jenis dari database
$query = "SELECT * FROM jenis WHERE id_jenis = $id_jenis";
$result = mysqli_query($connect, $query);
$jenis = mysqli_fetch_assoc($result);

if (!$jenis) {
    echo "<script>alert('Data jenis tidak ditemukan!');window.location.href='index.php';</script>";
    exit;
}
?>

<div class="container-fluid">
  <div class="page-inner">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-box-seam text-primary me-2"></i>Detail Jenis Barang
      </h2>
      <h5 class="text-muted">Informasi lengkap data jenis barang</h5>
    </div>

    <!-- Card Detail -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

          <!-- Gambar Barang -->
          <div class="text-center bg-light p-4">
            <img 
              src="../../../storages/jenis/<?= htmlspecialchars($jenis['image'] ?: 'no-image.png') ?>" 
              alt="<?= htmlspecialchars($jenis['nama_jenis']) ?>" 
              class="rounded-3 shadow-sm"
              style="max-height: 250px; object-fit: cover;">
          </div>

          <div class="card-body px-4 py-4">
            <table class="table table-bordered">
              <tr>
                <th width="30%" class="bg-light">Kode Jenis</th>
                <td>
                  <span class="badge bg-primary fs-6 px-3 py-2">
                    <?= htmlspecialchars($jenis['kode_jenis']) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <th class="bg-light">Nama Jenis</th>
                <td class="fw-semibold"><?= htmlspecialchars($jenis['nama_jenis']) ?></td>
              </tr>
              <tr>
                <th class="bg-light">Keterangan</th>
                <td>
                  <?php if (!empty($jenis['keterangan'])): ?>
                    <?= nl2br(htmlspecialchars($jenis['keterangan'])) ?>
                  <?php else: ?>
                    <span class="text-muted fst-italic">- Tidak ada keterangan -</span>
                  <?php endif; ?>
                </td>
              </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
              </a>
              <div>
                <a href="edit.php?id_jenis=<?= $jenis['id_jenis'] ?>" class="btn btn-purple px-4 me-2">
                  <i class="bi bi-pencil-square me-2"></i>Edit Data
                </a>
                <a href="action/jenis/destroy.php?id_jenis=<?= $jenis['id_jenis'] ?>" 
                   class="btn btn-danger px-4"
                   onclick="return confirm('Yakin ingin menghapus data jenis ini?')">
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
  .table th {
    font-weight: 600;
  }
  .bg-light {
    background-color: #f8f9fa !important;
  }
</style>

<?php
include '../../partials/footer.php';
?>
