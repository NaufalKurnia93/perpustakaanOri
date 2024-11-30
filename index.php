<?php
ob_start(); // Mulai buffering output

include_once('database/koneksi.php');
include_once('database/class/access.php');

$pdo = dataBase::connect();
$user = Access::getInstance($pdo);
$userInfo = $user->cari_pengguna();
//cek login
if ($user->cekLogin() == false) { //belum login
    $login = isset($_GET['access']) ? $_GET['access'] : 'access';
    switch ($login) {
        case 'login':
            include 'access/login.php';
            break;
        case 'register':
            include 'access/register.php';
            break;
        case 'forget':
            include 'access/lupaPaswd.php';
            break;
        default:
            include('access/login.php');
            break;
    }  
    exit;
}

    // elseif statement yang benar untuk cetak pdf
elseif (isset($_GET['mpdf'])) { // cek apakah ada parameter 'pdf'
    $mpdf = $_GET['mpdf'];

    switch ($mpdf) {
        case 'pdf':
            include 'page/peminjaman/laporanMpdf.php';
            break;
        default:
            // Redirect or handle unknown cetak values
            header('Location: index.php'); // ganti 'index.php' dengan halaman utama jika perlu
            exit;
    }
    
}else {
    ?>
    <!DOCTYPE html>
    <html lang="en" style="height: 100%;">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTEM PERPUSTAKAAN</title>
        <?php include 'layout/stylecss.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div class="app" style="min-height: 100vh;">
            <?php
            include("layout/header.php");
            include("layout/sidebar.php");
            ?>

            <div class="main-content">
                <section class=" section">
                    <?php
                    $halaman_get = isset($_GET['page']) ? $_GET['page'] : "";
                    switch ($halaman_get) {
                        case 'anggota':
                            include('page/anggota/default.php');
                            break;
                        case 'petugas':
                            include('page/petugas/default.php');
                            break;
                        case 'penulis':
                            include('page/penulis/default.php');
                            break;
                        case 'kategori':
                            include('page/kategori/default.php');
                            break;
                        case 'buku':
                            include('page/buku/default.php');
                            break;
                        case 'peminjaman':
                            include('page/peminjaman/default.php');
                            break;
                        case 'logout':
                            include 'access/aksesLogout.php';
                            break;
                        default:
                            include('page/dashboard/index.php');
                            break;
                    }
                    ?>
                </section>
            </div>
        </div>
        <?php
        include 'layout/footer.php';

        ?>

        <!-- Script untuk menginisialisasi DataTables -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable(); // Menginisialisasi DataTables untuk semua tabel di halaman
            });
        </script>

        <?php

        include "layout/stylejs.php";
        ?>
    </body>

    </html>
    <?php
}
ob_end_flush(); // Hentikan buffering output dan kirim output ke browser
?>