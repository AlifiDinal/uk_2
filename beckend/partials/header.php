<?php
   session_start();
 include '../../app.php';

 // mengecek  apakah user sudah login 
  if(!isset($_SESSION['username'])){
       echo "
           <script>
               alert('Anda Harus Login Dahulu');
             window.location.href='../auth/login.php';
          </script>    
        ";   
    } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Aplikasi Inventaris Sarana dan Prasarana</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../../templates_admin/assets/img/logo.png?v=2"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="../../templates_admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../../templates_admin/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../templates_admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../templates_admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../../templates_admin/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../templates_admin/assets/css/demo.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  </head>