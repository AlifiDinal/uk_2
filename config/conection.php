<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "projek_uk2";

// Buat koneksi
$connect = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($connect->connect_error) {
    die("Koneksi gagal: " . $connect->connect_error);
}
?>
