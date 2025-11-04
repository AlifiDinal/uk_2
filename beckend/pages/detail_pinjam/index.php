<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Ambil keyword dari GET
$keyword = $_GET['keyword'] ?? '';
$safeKeyword = mysqli_real_escape_string($connect, $keyword);

// Query JOIN antar tabel
$qDetail = "
  SELECT 
    dp.id_detail_pinjam,
    p.id_peminjaman,
    i.id_inventaris,
    i.nama AS nama_inventaris,
    i.kode_inventaris,
    p.tanggal_pinjam,
    p.tanggal_kembali,
    dp.jumlah,
    p.status_peminjaman
  FROM detail_pinjam dp
  LEFT JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
  LEFT JOIN inventaris i ON dp.id_inventaris = i.id_inventaris
  ORDER BY dp.id_detail_pinjam DESC
";


// Filter pencarian
if (!empty($keyword)) {
  $qDetail .= " WHERE i.id_detail_pinjam LIKE '%$safeKeyword%'
                OR i.id_peminjaman LIKE '%$safeKeyword%'
                OR p.id_inventaris LIKE '%$safeKeyword%'";
}

if (in_array($_SESSION['id_level'], ['Admin', 'operator'])):

$resultDetail = mysqli_query($connect, $qDetail) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="page-inner py-5">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-archive-fill text-primary me-2"></i> Halaman Detail Pinjam
      </h2>
      <h5 class="text-muted">Daftar barang yang dipinjam</h5>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-gradient d-flex justify-content-between align-items-center p-3">
          <a href="./create.php" class="btn btn-primary fw-bold d-flex align-items-center gap-2 rounded-pill px-3">
            <i class="bi bi-plus-circle"></i> Tambah Detail 
          </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Kode Pengembalian</th>
                <th>Id Pinjam</th>
                <th>Jumlah</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (mysqli_num_rows($resultDetail) > 0):
                while ($item = $resultDetail->fetch_object()):
              ?>
                <tr>  
                  <td><?= $no ?></td>
                  <td><span class="badge bg-info text-dark px-3 py-2"><?= htmlspecialchars($item->kode_inventaris) ?></td>
                  <td class="fw-semibold">  <?= htmlspecialchars($item->id_peminjaman) ?></td>
                  <td><?= htmlspecialchars($item->jumlah) ?></td>
                  <td>
                    <a href="./edit.php?id_detail_pinjam=<?= $item->id_detail_pinjam ?>" 
                       class="btn btn-sm btn-outline-warning me-1 shadow-sm">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="../../action/detail_pinjam/destroy.php?id_detail_pinjam=<?= $item->id_detail_pinjam ?>"
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
                  <td colspan="9" class="text-center text-muted">Tidak ada data ditemukan</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- DataTables -->
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

<?php else: ?>
  <script>
    alert('Tidak dapat mengakses halaman ini');
    window.location.href='../../pages/peminjaman/index.php';
  </script>
<?php endif; ?>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
