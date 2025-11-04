<?php
// Deteksi halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);

  if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar bg-primary text-white d-flex flex-column" data-background-color="dark" style="height: 200vh; overflow: hidden;">

    <div class="sidebar-logo text-center py-4 border-bottom border-light border-opacity-25 flex-shrink-0">
      <!-- Logo -->
      <div class="rounded-circle d-inline-flex justify-content-center align-items-center shadow-sm"
          style="width: 50px; height: 50px; overflow: hidden;">
        <img src="../../templates_admin/assets/img/logo.png?v=2"
            alt="Logo"
            style="width: 110%; height: 110%; object-fit: cover;">
      </div>

      <!-- App name -->
      <h6 class="mb-1 text-white mt-2 fw-bold letter-spacing">INVENTARIS APP</h6>

      <!-- User role -->
      <div class="profile-username mt-1">
        <span class="fw-semibold text-white-50 small">
          <?= isset($_SESSION['nama_petugas']) ? htmlspecialchars($_SESSION['nama_petugas']) : 'Guest' ?>
        </span>
      </div>
    </div>

      <!-- Sidebar Menu Scrollable -->
      <div class="sidebar-wrapper flex-grow-1 overflow-auto">
        <div class="sidebar-content py-2">
          <ul class="nav nav-primary">

            <!-- Dashboard -->
            <?php if ($_SESSION['id_level'] === 'Admin'): ?>
            <li class="nav-item <?= ($current_page == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : '' ?>"> 
                <a href="../dashboard/index.php" class="d-flex align-items-center text-white px-2 py-2"> 
                  <i class="fas fa-tachometer-alt me-3"></i> 
                  <p class="mb-0">Dashboard</p> 
                </a> </li> <li class="nav-section mt-1">
            </li>
            <?php endif; ?>

            <div class="sidebar-divider"></div>

            <li class="nav-section mt-1">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Data Master</h4>
            </li>

            <!-- Dropdown Data Master (Gabungan Barang & Peminjaman) -->
            <li class="nav-item">
              <a class="d-flex align-items-center px-3 py-3 collapsed" 
                data-bs-toggle="collapse" 
                href="#dataMasterMenu" 
                role="button" 
                aria-expanded="<?= (
                    strpos($_SERVER['REQUEST_URI'], 'jenis') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'inventaris') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'peminjaman') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'ruang') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'detail_pinjam') !== false
                  ) ? 'true' : 'false' ?>" 
                aria-controls="dataMasterMenu">
                <i class="fas fa-database me-3"></i>
                <p class="mb-0">Data Master</p>
                <i class="fas fa-caret-down ms-auto small rotate-icon"></i>
              </a>

              <div class="collapse <?= (
                    strpos($_SERVER['REQUEST_URI'], 'jenis') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'inventaris') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'peminjaman') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'ruang') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'detail_pinjam') !== false
                  ) ? 'show' : '' ?>" id="dataMasterMenu">
                  
                <ul class="nav flex-column ms-4 border-start border-light border-opacity-25 ps-3">

                  <!-- Jenis -->
                   <?php if ($_SESSION['id_level'] === 'Admin'): ?>
                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'jenis') !== false) ? 'active' : '' ?>">
                    <a href="../jenis/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-box me-2"></i>
                      <p class="mb-0">Jenis Barang</p>
                    </a>
                  </li>
                  
                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'ruang') !== false) ? 'active' : '' ?>">
                    <a href="../ruang/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-door-open me-2"></i>
                      <p class="mb-0">Ruang</p>
                    </a>
                  </li>

                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'detail_pinjam') !== false) ? 'active' : '' ?>">
                    <a href="../detail_pinjam/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-list-alt me-2"></i>
                      <p class="mb-0">Detail Peminjaman</p>
                    </a>
                  </li>
                  <?php endif; ?>

                  <!-- Peminjaman --> 
                <?php if (in_array($_SESSION['id_level'], ['Admin','operator'])): ?>  
                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'peminjaman') !== false) ? 'active' : '' ?>">
                    <a href="../peminjaman/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-hand-holding me-2"></i>
                      <p class="mb-0">Peminjaman</p>
                    </a>
                  </li>

                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'inventaris') !== false) ? 'active' : '' ?>">
                    <a href="../inventaris/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-warehouse me-2"></i>
                      <p class="mb-0">Pengembalian</p>
                    </a>
                  </li>
                <?php endif; ?> 

                </ul>
              </div>
            </li>

           <div class="sidebar-divider"></div>

          <?php if ($_SESSION['id_level'] === 'Admin'): ?>
           <li class="nav-section mt-1">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Operator</h4>
           </li>

           <!-- Dropdown Manajemen Petugas -->
            <li class="nav-item">
              <a class="d-flex align-items-center px-3 py-3 collapsed" 
                data-bs-toggle="collapse" 
                href="#menuPetugas" 
                role="button" 
                aria-expanded="<?= (
                    strpos($_SERVER['REQUEST_URI'], 'operator') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'level') !== false ||
                    strpos($_SERVER['REQUEST_URI'], 'pegawai') !== false 
                  ) ? 'true' : 'false' ?>" 
                aria-controls="menuPetugas">
                <i class="fas fa-users-cog me-3"></i>
                <p class="mb-0">Manajemen Petugas</p>
                <i class="fas fa-caret-down ms-auto small rotate-icon"></i>
              </a>

              <div class="collapse <?= (
                    strpos($_SERVER['REQUEST_URI'], 'operator') !== false || 
                    strpos($_SERVER['REQUEST_URI'], 'level') !== false ||
                    strpos($_SERVER['REQUEST_URI'], 'pegawai') !== false 
                  ) ? 'show' : '' ?>" id="menuPetugas">

                <ul class="nav flex-column ms-4 border-start border-light border-opacity-25 ps-3">
                  
                  <!-- Operator -->
                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'operator') !== false) ? 'active' : '' ?>">
                    <a href="../operator/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-user-tie me-2"></i>
                      <p class="mb-0">Operator</p>
                    </a>
                  </li>

                  <!-- Level -->
                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'level') !== false) ? 'active' : '' ?>">
                    <a href="../level/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-layer-group me-2"></i>
                      <p class="mb-0">Level</p>
                    </a>
                  </li>

                  <li class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'pegawai') !== false) ? 'active' : '' ?>">
                    <a href="../pegawai/index.php" class="d-flex align-items-center px-3 py-2">
                      <i class="fas fa-layer-group me-2"></i>
                      <p class="mb-0">Pegawai</p>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
            <?php endif; ?>

            <!-- Garis pembatas antar section -->
            <li class="nav-section mt-2"></li>

          </ul>
        </div>
      </div>
      <!-- End Sidebar Menu -->
    </div>
    <!-- End Sidebar -->

 <style>
  .sidebar {
    background: linear-gradient(135deg, #010914ff 0%, #303030ff 100%);
    color: white;
    min-width: 260px;
    max-width: 260px;
    box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.1);
  }

  .sidebar::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar-wrapper::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar-wrapper::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
  }

  .sidebar .nav-item {
    transition: all 0.2s ease;
    margin: 2px 8px;
    border-radius: 8px;
  }

  .sidebar .nav-item a {
    color: rgba(255, 255, 255, 0.85);
    font-weight: 500;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
  }

  .sidebar .nav-item.active,
  .sidebar .nav-item:hover {
    background-color: rgba(255, 255, 255, 0.15);
  }

  .sidebar .nav-item.active a,
  .sidebar .nav-item:hover a {
    color: #fff;
  }

  .rotate-icon {
    transition: transform 0.3s ease;
  }

  a[aria-expanded="true"] .rotate-icon {
    transform: rotate(90deg);
  }

  .nav-section h4 {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0;
    color: rgba(255, 255, 255, 0.6);
  }

  .sidebar-divider {
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
    margin: 8px 0;
  }
</style>

<style>
  .profile-username {
    display: block;
    text-align: center;
    color: rgba(255, 255, 255, 0.75);
    font-size: 0.85rem;
    letter-spacing: 0.5px;
  }

</style>