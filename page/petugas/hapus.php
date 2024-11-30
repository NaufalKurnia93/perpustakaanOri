<?php

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
    // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
    echo "<script>window.location = 'index.php?page=anggota&cek=rawrIzin';</script>";
    exit; // Menghentikan eksekusi script
}

if (empty($_GET['id_petugas'])) {
    header("Location: index.php");
}

$id_petugas = $_GET['id_petugas'];

$pdo = dataBase::connect();
$petugas = Petugas::getInstance($pdo);
$result = $petugas->hapus($id_petugas);
dataBase::disconnect();

if ($result == true) {
    echo "<script>window.location.href = 'index.php?page=petugas&cek=del';</script>";
} else {
   echo "<script>window.location.href = 'index.php?page=petugas&cek=failed';</script>";
}

?>