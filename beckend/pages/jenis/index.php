<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Ambil keyword dari GET
$keyword = $_GET['keyword'] ?? '';
$safeKeyword = mysqli_real_escape_string($connect, $keyword);

// Query jenis + filter pencarian
$qJenis = "SELECT * FROM jenis";
if (!empty($keyword)) {
  $qJenis .= " WHERE nama_jenis LIKE '%$safeKeyword%' 
               OR kode_jenis LIKE '%$safeKeyword%' 
               OR keterangan LIKE '%$safeKeyword%'";
}

$resultJenis = mysqli_query($connect, $qJenis) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="page-inner py-5">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-tags-fill text-primary me-2"></i> Halaman Jenis Barang
      </h2>
      <h5 class="text-muted">Daftar kategori / jenis jenis</h5>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-gradient d-flex justify-content-between align-items-center p-3">
        <a href="./create.php" class="btn btn-primary fw-bold d-flex align-items-center gap-2 rounded-pill px-3">
          <i class="bi bi-plus-circle"></i> Tambah Jenis
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Kode Jenis</th>
                <th>Nama Jenis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (mysqli_num_rows($resultJenis) > 0):
                while ($item = $resultJenis->fetch_object()):
                  // DEBUG: Tampilkan informasi gambar untuk troubleshooting
                  // echo "<!-- Debug: image value: " . $item->image . " -->";
                  
                  // Path gambar - sesuaikan dengan struktur project Anda
                  $imagePath = "../../../storages/jenis/" . $item->image;
                  $imageExists = (!empty($item->image) && file_exists($imagePath));
                  
                  // Jika path sebelumnya tidak bekerja, coba path alternatif
                  if (!$imageExists) {
                    $imagePath = "../../../../storages/jenis/" . $item->image;
                    $imageExists = (!empty($item->image) && file_exists($imagePath));
                  }
                  
                  // Jika masih tidak ada, coba path dari root
                  if (!$imageExists) {
                    $imagePath = "/storages/jenis/" . $item->image;
                    $imageExists = (!empty($item->image) && file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath));
                  }
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td>
                    <?php if ($imageExists && !empty($item->image)) : ?>
                      <img src="<?= $imagePath ?>" 
                           alt="Gambar <?= htmlspecialchars($item->nama_jenis) ?>" 
                           class="img-fluid rounded shadow-sm" 
                           style="width: 90px; height: 90px; object-fit: cover;">
                    <?php else : ?>
                      <div class="bg-light rounded d-flex align-items-center justify-content-center border" 
                           style="width: 90px; height: 90px;">
                        <small class="text-muted">No Image</small>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="badge bg-info text-dark px-3 py-2">
                      <?= htmlspecialchars($item->kode_jenis) ?>
                    </span>
                  </td>
                  <td class="fw-semibold"><?= htmlspecialchars($item->nama_jenis) ?></td>
                  <td>
                    <a href="./edit.php?id_jenis=<?= $item->id_jenis ?>" 
                       class="btn btn-sm btn-outline-warning me-1 shadow-sm">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="./detail.php?id_jenis=<?= $item->id_jenis ?>" 
                      class="btn btn-sm btn-outline-info me-1 shadow-sm">
                      <i class="bi bi-info-circle"></i>
                    </a>
                    <a href="../../action/jenis/destroy.php?id_jenis=<?= $item->id_jenis ?>"
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
                  <td colspan="6" class="text-center text-muted">Tidak ada data ditemukan</td>
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

<!-- Custom Style -->
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
  .text-purple {
    color: #6f42c1;
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