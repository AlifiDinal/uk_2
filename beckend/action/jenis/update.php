<?php
include '../../../config/conection.php';

// Cek apakah form disubmit
if (isset($_POST['tombol'])) {
    $id_jenis = intval($_POST['id_jenis']);
    $nama_jenis = mysqli_real_escape_string($connect, $_POST['nama_jenis']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $old_image = mysqli_real_escape_string($connect, $_POST['old_image']);

    // Default: tetap pakai gambar lama
    $new_image = $old_image;

    // Pastikan folder upload tersedia
    $uploadDir = '../../../storages/jenis/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Cek apakah ada file gambar yang diupload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];

        // Ambil ekstensi
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Ekstensi yang diizinkan
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowedExt)) {
            if ($fileSize <= 2097152) { // max 2MB
                // Generate nama unik
                $newFileName = uniqid('JENIS_', true) . '.' . $fileExt;
                $uploadPath = $uploadDir . $newFileName;

                // Upload file
                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    $new_image = $newFileName;

                    // Hapus gambar lama jika bukan default
                    if (!empty($old_image) && $old_image !== 'no-image.png') {
                        $oldImagePath = $uploadDir . $old_image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                } else {
                    echo "<script>alert('Gagal mengupload gambar!'); window.history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Ukuran gambar terlalu besar (maks 2MB)!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Format gambar tidak didukung! (Gunakan JPG, JPEG, PNG, GIF)'); window.history.back();</script>";
            exit;
        }
    }

    // Update database
    $query = "UPDATE jenis SET 
              nama_jenis = '$nama_jenis',
              keterangan = '$keterangan',
              image = '$new_image'
              WHERE id_jenis = $id_jenis";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='../../pages/jenis/index.php';</script>";
    } else {
        echo "<script>alert('Gagal update data: " . mysqli_error($connect) . "'); window.history.back();</script>";
    }
} else {
    header("Location: ../../pages/jenis/index.php");
    exit;
}
?>
