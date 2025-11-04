<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id_jenis   = strtolower(escapeString($_POST['id_jenis']));
    $nama_jenis = escapeString($_POST['nama_jenis']);
    $kode_jenis = escapeString($_POST['kode_jenis']);
    $keterangan = escapeString($_POST['keterangan']);

    // Konfigurasi upload
    $storages = "../../../storages/jenis/";
    $fileName = $_FILES['image']['name'] ?? null;
    $tmpName  = $_FILES['image']['tmp_name'] ?? null;
    $imageName = null;

    // Upload gambar (jika ada)
    if (!empty($fileName) && is_uploaded_file($tmpName)) {
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $imageName = time() . '.' . $ext;
            move_uploaded_file($tmpName, $storages . $imageName);
        } else {
            echo "<script>alert('Format gambar tidak valid (gunakan JPG, PNG, atau GIF)'); window.history.back();</script>";
            exit;
        }
    }

    // Tetap sertakan kolom image (kosong jika tidak upload)
    $qInsert = "INSERT INTO jenis (id_jenis, nama_jenis, kode_jenis, keterangan, image) 
                VALUES ('$id_jenis', '$nama_jenis', '$kode_jenis', '$keterangan', " . 
                ($imageName ? "'$imageName'" : "''") . ")";

    // Eksekusi query
    if (mysqli_query($connect, $qInsert)) {
        echo "<script>alert('✅ Data berhasil ditambahkan'); window.location.href='../../pages/jenis/index.php';</script>";
    } else {
        echo "<script>alert('❌ Gagal menambah data: " . mysqli_error($connect) . "'); window.history.back();</script>";
    }
}
?>
