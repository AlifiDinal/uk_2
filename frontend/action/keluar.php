<?php
// Pastikan session aktif dulu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua session yang digunakan saat login
unset($_SESSION['nama_pegawai']);
unset($_SESSION['nip']);

// Atau bisa juga langsung kosongkan semua session
session_unset();

// Hancurkan session di server
session_destroy();

// Hapus cookie session di browser (biar benar-benar bersih)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Arahkan user ke halaman login
echo "
    <script>
        alert('Anda telah berhasil keluar dari sistem.');
        window.location.href = '../index.php';
    </script>
";
exit;
?>
