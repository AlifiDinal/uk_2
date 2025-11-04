<?php
     // untuk memulai sesi $_session
    session_start();
    // menghapus semua variabel sesi, artinya smua data yang di $_session akan dihaps
    session_unset();
    // menhhancurkn sesi sepenuhnya, dan sesi akan di hapus dari server
    session_destroy();

    echo "
            <script>
                alert('Berhasil Logout');
                window.location.href='../../pages/auth/login.php';
            </script>    
        ";

?>