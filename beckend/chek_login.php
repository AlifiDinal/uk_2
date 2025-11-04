<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect ke login jika tidak ada session
if (!isset($_SESSION['id_level']) || !isset($_SESSION['nama_level'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

// Include file ini di setiap halaman yang membutuhkan login