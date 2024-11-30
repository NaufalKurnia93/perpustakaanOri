<?php

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
   // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
   echo "<script>window.location = 'index.php?page=anggota&cek=rawrIzin';</script>";
   exit; // Menghentikan eksekusi script
}

 if(empty($_GET['id_penulis'])) {
  header("Location: index.php");
 } 

 $id_penulis = $_GET['id_penulis'];

 $pdo = dataBase::connect();
 $penulis = Penulis::getInstance($pdo);
 $result = $penulis->hapus($id_penulis);
 dataBase::disconnect();
 
 if ($result == true) {
    echo "<script>window.location.href = 'index.php?page=penulis&cek=del';</script>";
} else {
   echo "<script>window.location.href = 'index.php?page=penulis&cek=failed';</script>";
}
 
 ?>