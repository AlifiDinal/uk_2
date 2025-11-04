<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Ambil keyword untuk pencarian
$keyword = $_GET['keyword'] ?? '';
$safeKeyword = mysqli_real_escape_string($connect, $keyword);

// Query inventaris + relasi
$qInventaris = "
    SELECT 
        i.id_inventaris,
        i.nama,
        i.kondisi,
        i.keterangan,
        i.jumlah,
        i.tanggal_register,
        i.kode_inventaris,
        j.nama_jenis,
        r.nama_ruang,
        p.nama_petugas
    FROM inventaris i
    LEFT JOIN jenis j ON i.id_jenis = j.id_jenis
    LEFT JOIN ruang r ON i.id_ruang = r.id_ruang
    LEFT JOIN petugas p ON i.id_petugas = p.id_petugas
";

if (!empty($keyword)) {
    $qInventaris .= "
        WHERE i.nama LIKE '%$safeKeyword%'
        OR i.kode_inventaris LIKE '%$safeKeyword%'
        OR j.nama_jenis LIKE '%$safeKeyword%'
        OR r.nama_ruang LIKE '%$safeKeyword%'
        OR p.nama_petugas LIKE '%$safeKeyword%'
    ";
}

$qInventaris .= " ORDER BY i.id_inventaris DESC";
$resultInventaris = mysqli_query($connect, $qInventaris) or die(mysqli_error($connect));
?>

<div class="container-fluid">
  <div class="page-inner py-5">

    <!-- Judul Halaman -->
    <div class="text-center py-5">
      <h2 class="fw-bold mb-2 mt-4 text-dark display-5">
        <i class="bi bi-box-seam text-primary me-2"></i> Halaman Pengembalian 
      </h2>
      <h5 class="text-muted">Daftar Pengembalian lengkap dengan jenis, ruang, dan petugas</h5>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-gradient d-flex justify-content-between align-items-center p-3">
        <a href="./create.php" class="btn btn-primary fw-bold d-flex align-items-center gap-2 rounded-pill px-3">
          <i class="bi bi-plus-circle"></i> Tambah Pengembalian
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Kode Pengembalian</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Petugas</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (mysqli_num_rows($resultInventaris) > 0):
                while ($item = $resultInventaris->fetch_object()):
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><span class="badge bg-info text-dark px-3 py-2"><?= htmlspecialchars($item->kode_inventaris) ?></span></td>
                  <td class="fw-semibold"><?= htmlspecialchars($item->nama) ?></td>
                  <td><?= htmlspecialchars($item->nama_jenis ?? '-') ?></td>
                  <td><?= htmlspecialchars($item->tanggal_register) ?></td>
                  <td class="fw-semibold"><?= htmlspecialchars($item->nama_petugas ?? '-') ?></td>
                  <td>
                    <a href="./edit.php?id_inventaris=<?= $item->id_inventaris ?>" 
                       class="btn btn-sm btn-outline-warning me-1 shadow-sm" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="./detail.php?id_inventaris=<?= $item->id_inventaris ?>" 
                      class="btn btn-sm btn-outline-info me-1 shadow-sm">
                      <i class="bi bi-info-circle"></i>
                    </a>
                    <a href="../../action/inventaris/destroy.php?id_inventaris=<?= $item->id_inventaris ?>"
                       class="btn btn-sm btn-outline-danger shadow-sm"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
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
                  <td colspan="10" class="text-center text-muted">Tidak ada data ditemukan</td>
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
