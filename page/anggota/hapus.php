<?php

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
    // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
    echo "<script>window.location = 'index.php?page=anggota&cek=rawrIzin';</script>";
    exit; // Menghentikan eksekusi script
}


 if(empty($_GET['id_anggota'])) {
  header("Location: index.php");
 } 

 $id_anggota = $_GET['id_anggota'];

 $pdo = dataBase::connect();
 $anggota = Anggota::getInstance($pdo);
 $result = $anggota->hapus($id_anggota);
 dataBase::disconnect();
 
 if ($result) {
     echo "<script>window.location.href = 'index.php?page=anggota&cek=del';</script>";
 } else {
    echo "<script>window.location.href = 'index.php?page=anggota&cek=failed';</script>";
 }
 
 ?>

