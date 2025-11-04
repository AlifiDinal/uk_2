<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../../config/conection.php';

// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Cek role admin
if ($_SESSION['id_level'] !== 'Admin') {
  echo "
    <script>
      alert('Tidak dapat mengakses halaman ini');
      window.location.href='../../pages/peminjaman/index.php';
    </script>
  ";
  exit;
}

// ===== Query total data =====
$dataJenis = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM jenis"))['total'] ?? 0;
$dataPeminjaman = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM peminjaman"))['total'] ?? 0;
$dataInventaris = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM inventaris"))['total'] ?? 0;

// ===== Cek kolom tanggal =====
$columns = [];
$resCols = mysqli_query($connect, "SHOW COLUMNS FROM peminjaman");
while ($col = mysqli_fetch_assoc($resCols)) {
  $columns[] = $col['Field'];
}

if (in_array('tanggal_pinjam', $columns)) {
  $fieldTanggal = 'tanggal_pinjam';
} elseif (in_array('tgl_pinjam', $columns)) {
  $fieldTanggal = 'tgl_pinjam';
} elseif (in_array('tanggal', $columns)) {
  $fieldTanggal = 'tanggal';
} else {
  $fieldTanggal = null;
}

// ===== Statistik Bulanan =====
$dataBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
$dataJumlah = array_fill(0, 12, 0);

if ($fieldTanggal) {
  $q = "
    SELECT MONTH($fieldTanggal) AS bulan, COUNT(*) AS total
    FROM peminjaman
    WHERE $fieldTanggal IS NOT NULL
    GROUP BY MONTH($fieldTanggal)
    ORDER BY bulan
  ";
  $result = mysqli_query($connect, $q);

  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $bulanIndex = (int)$row['bulan'] - 1;
      $dataJumlah[$bulanIndex] = (int)$row['total'];
    }
  } else {
    echo "<div class='alert alert-warning text-center mt-3'>⚠️ Tidak ada data peminjaman ditemukan.</div>";
  }
} else {
  echo "<div class='alert alert-danger text-center mt-3'>❌ Kolom tanggal peminjaman tidak ditemukan di tabel!</div>";
}

// ===== Ambil data peminjaman =====
$qPeminjaman = "
  SELECT 
    p.id_peminjaman,
    p.tanggal_pinjam,
    p.tanggal_kembali,
    p.status_peminjaman,
    pg.nama_pegawai
  FROM peminjaman p
  LEFT JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
  ORDER BY p.id_peminjaman DESC
";
$resultPeminjaman = mysqli_query($connect, $qPeminjaman);
?>

<div class="container-fluid py-5">

  <!-- Header -->
  <div class="text-center py-4">
    <h2 class="fw-bold mb-2 mt-4 text-dark display-6">
      <i class="bi bi-house-door-fill me-2 text-primary"></i>Selamat Datang
    </h2>
    <h5 class="text-muted">Sistem Inventaris Sarana dan Prasarana</h5>
  </div>

  <!-- Statistik Kartu -->
  <div class="row g-4 justify-content-center mb-5">
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="../jenis/index.php" class="text-decoration-none">
        <div class="card dashboard-card bg-gradient-primary text-white text-center p-4 border-0 rounded-4 shadow-hover">
          <div class="card-icon bg-white text-primary mx-auto mb-3">
            <i class="bi bi-box-seam"></i>
          </div>
          <h3 class="fw-bold"><?= $dataJenis ?></h3>
          <p class="small opacity-75 mb-0">Total jenis barang</p>
        </div>
      </a>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="../peminjaman/index.php" class="text-decoration-none">
        <div class="card dashboard-card bg-gradient-success text-white text-center p-4 border-0 rounded-4 shadow-hover">
          <div class="card-icon bg-white text-success mx-auto mb-3">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <h3 class="fw-bold"><?= $dataPeminjaman ?></h3>
          <p class="small opacity-75 mb-0">Total transaksi peminjaman</p>
        </div>
      </a>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="../inventaris/index.php" class="text-decoration-none">
        <div class="card dashboard-card bg-gradient-warning text-dark text-center p-4 border-0 rounded-4 shadow-hover">
          <div class="card-icon bg-dark text-warning mx-auto mb-3">
            <i class="bi bi-cash-stack"></i>
          </div>
          <h3 class="fw-bold"><?= $dataInventaris ?></h3>
          <p class="small opacity-75 mb-0">Total barang inventaris</p>
        </div>
      </a>
    </div>
  </div>

  <!-- ====== DataTable Peminjaman ====== -->
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h5 class="fw-bold mb-0 text-primary">
        <i class="bi bi-table me-2"></i>Daftar Data Peminjaman
      </h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="peminjamanTable" class="table table-hover align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Peminjam</th>
              <th>Tanggal Pinjam</th>
              <th>Tanggal Kembali</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if ($resultPeminjaman && mysqli_num_rows($resultPeminjaman) > 0):
              while ($row = mysqli_fetch_assoc($resultPeminjaman)):
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama_pegawai'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
              <td><?= htmlspecialchars($row['tanggal_kembali']) ?></td>
              <td>
                <span class="badge bg-<?= $row['status_peminjaman'] == 'Dipinjam' ? 'warning' : 'success' ?>">
                  <?= htmlspecialchars($row['status_peminjaman']) ?>
                </span>
              </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
              <td colspan="6" class="text-muted">Tidak ada data peminjaman ditemukan.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>

<!-- ===== Chart.js & DataTables ===== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
const ctx = document.getElementById('chartPeminjaman').getContext('2d');
const data = {
  labels: <?= json_encode($dataBulan) ?>,
  datasets: [{
    label: 'Jumlah Peminjaman',
    data: <?= json_encode($dataJumlah) ?>,
    fill: true,
    backgroundColor: 'rgba(91,108,247,0.2)',
    borderColor: '#5b6cf7',
    tension: 0.4,
    pointBackgroundColor: '#5b6cf7',
    pointRadius: 5,
  }]
};
new Chart(ctx, { type: 'line', data });

document.getElementById('exportBtn').addEventListener('click', () => {
  const link = document.createElement('a');
  link.download = 'statistik_peminjaman.png';
  link.href = document.getElementById('chartPeminjaman').toDataURL();
  link.click();
});

$(document).ready(function () {
  $('#peminjamanTable').DataTable({
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
  .bg-gradient-primary { background: linear-gradient(135deg, #5b6cf7, #3a45c4); }
  .bg-gradient-success { background: linear-gradient(135deg, #00c6a7, #1eae98); }
  .bg-gradient-warning { background: linear-gradient(135deg, #ffb75e, #ed8f03); }
  .dashboard-card {
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
  }
  .dashboard-card::after {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: rgba(255,255,255,0.05);
    transform: rotate(25deg);
    transition: 0.8s ease;
  }
  .dashboard-card:hover::after {
    top: -10%; left: -10%; opacity: 0.2;
  }
  .dashboard-card:hover { transform: translateY(-10px); }
  .card-icon {
    width: 75px; height: 75px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.2rem; box-shadow: 0 4px 10px rgba(255,255,255,0.3);
    transition: all 0.3s ease;
  }
  .dashboard-card:hover .card-icon {
    transform: scale(1.15);
    box-shadow: 0 0 20px rgba(255,255,255,0.6);
  }
</style>
