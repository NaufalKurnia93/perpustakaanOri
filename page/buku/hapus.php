<?php

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
    // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
    echo "<script>window.location = 'index.php?page=anggota&cek=rawrIzin';</script>";
    exit; // Menghentikan eksekusi script
}

if (empty($_GET['id_buku'])) {
    header("Location: index.php");
}

$id_buku = $_GET['id_buku'];

$pdo = dataBase::connect();
$buku = Buku::getInstance($pdo);
$result = $buku->hapus($id_buku);
dataBase::disconnect();

if ($result == true) {
    echo "<script>window.location.href = 'index.php?page=buku&cek=del';</script>";
} else {
   echo "<script>window.location.href = 'index.php?page=buku&cek=failed';</script>";
}

?>