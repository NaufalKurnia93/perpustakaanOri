<?php

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
    // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
    echo "<script>window.location = 'index.php?page=anggota&cek=rawrIzin';</script>";
    exit; // Menghentikan eksekusi script
}

if (empty($_GET['id_kategori'])) {
    header("Location: index.php");
}

$id_kategori = $_GET['id_kategori'];

$pdo = dataBase::connect();
$kategori = Kategori::getInstance($pdo);
$result = $kategori->hapus($id_kategori);
dataBase::disconnect();

if ($result == true) {
    echo "<script>window.location.href = 'index.php?page=kategori&cek=del';</script>";
} else {
   echo "<script>window.location.href = 'index.php?page=kategori&cek=failed';</script>";
}

?>