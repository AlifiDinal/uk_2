<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Ambil keyword dari GET
$keyword = $_GET['keyword'] ?? '';
$safeKeyword = mysqli_real_escape_string($connect, $keyword);

// Query JOIN ke tabel level
$qPetugas = "
  SELECT 
    p.id_petugas,
    p.nama_petugas,
    l.nama_level
  FROM petugas p
  LEFT JOIN level l ON p.id_level = l.id_level
  ORDER BY p.id_petugas DESC
";

// Jika ada pencarian
if (!empty($keyword)) {
  $qPetugas = "
    SELECT 
      p.id_petugas,
      p.nama_petugas,
      l.nama_level
    FROM petugas p
    LEFT JOIN level l ON p.id_level = l.id_level
    WHERE 
      p.id_petugas LIKE '%$safeKeyword%' 
      OR p.nama_petugas LIKE '%$safeKeyword%' 
      OR l.nama_level LIKE '%$safeKeyword%'
    ORDER BY p.id_petugas DESC
  ";
}

$resultPetugas = mysqli_query($connect, $qPetugas) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="page-inner py-5">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-tags-fill text-primary me-2"></i> Halaman Operator
      </h2>
      <h5 class="text-muted">Daftar Petugas & Level</h5>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-gradient d-flex justify-content-between align-items-center p-3">
        <a href="./create.php" class="btn btn-primary fw-bold d-flex align-items-center gap-2 rounded-pill px-3">
          <i class="bi bi-plus-circle"></i> Tambah Petugas
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>ID Petugas</th>
                <th>Nama Petugas</th>
                <th>Level Petugas</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (mysqli_num_rows($resultPetugas) > 0):
                while ($item = $resultPetugas->fetch_object()):
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td>
                    <span class="badge bg-info text-dark px-3 py-2">
                      <?= htmlspecialchars($item->id_petugas) ?>
                    </span>
                  </td>
                  <td><?= htmlspecialchars($item->nama_petugas ?? '-') ?></td>
                  <td><?= htmlspecialchars($item->nama_level ?? '-') ?></td>
                  <td>
                    <a href="./edit.php?id_petugas=<?= $item->id_petugas ?>" 
                       class="btn btn-sm btn-outline-warning me-1 shadow-sm">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="./detail.php?id_petugas=<?= $item->id_petugas ?>" 
                      class="btn btn-sm btn-outline-info me-1 shadow-sm">
                      <i class="bi bi-info-circle"></i>
                    </a>
                    <a href="../../action/operator/destroy.php?id_petugas=<?= $item->id_petugas ?>"
                       class="btn btn-sm btn-outline-danger shadow-sm"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php
                $no++;
                endwhile;
              else:
              ?>
                <tr>
                  <td colspan="5" class="text-center text-muted">Tidak ada data ditemukan</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- DataTables Style & Script -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      language: {
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
        infoEmpty: "Tidak ada data tersedia",
        infoFiltered: "(difilter dari total _MAX_ data)",
        search: "Cari:",
        paginate: {
          first: "Awal",
          last: "Akhir",
          next: "→",
          previous: "←"
        }
      }
    });
  });
</script>

<style>
  .btn-purple {
    background: linear-gradient(135deg, #6f42c1, #9d6bff);
    color: #fff;
    border-radius: 10px;
    transition: all 0.3s ease;
  }
  .btn-purple:hover {
    background: linear-gradient(135deg, #5a32a3, #854dff);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
  }
  .table-hover tbody tr:hover {
    background-color: #f9f3ff !important;
    transition: 0.3s;
  }
</style>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
