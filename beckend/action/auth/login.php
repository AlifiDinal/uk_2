<?php
session_start();
include '../../app.php'; // pastikan file ini berisi koneksi: $connect = mysqli_connect(...)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Query cek username + join ke tabel level
    $qSelect = "
        SELECT p.*, l.nama_level 
        FROM petugas p
        JOIN level l ON p.id_level = l.id_level
        WHERE p.username = ?
    ";

    $stmt = $connect->prepare($qSelect);
    if (!$stmt) {
        die("Query error: " . $connect->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
      
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_object();

        // Jika password di database belum di-hash, GANTI dengan ($password == $row->password)
        if ($password == $row->password || password_verify($password, $row->password)) {
            // Simpan session
            $_SESSION['id_petugas'] = $row->id_petugas;
            $_SESSION['username'] = $row->username;
            $_SESSION['nama_petugas'] = $row->nama_petugas;
            $_SESSION['id_level'] = $row->nama_level;
            $_SESSION['nama_level'] = $row->nama_level;

            // Opsional: log aktivitas
            if (function_exists('logActivity')) {
                logActivity($connect, $row->id_petugas, 'Login', 'User berhasil login ke sistem');
            }

            echo "
                <script>
                    alert('Berhasil login sebagai {$row->nama_level}');
                    window.location.href='../../pages/dashboard/index.php';
                </script>    
            ";
        } else {
            echo "
                <script>
                    alert('Password salah!');
                    window.location.href='../../pages/auth/login.php';
                </script>
            ";   
        }
    } else {
        echo "
            <script>
                alert('Username salah atau belum terdaftar!');
                window.location.href='../../pages/auth/login.php';
            </script>
        ";
    }
}
?>
