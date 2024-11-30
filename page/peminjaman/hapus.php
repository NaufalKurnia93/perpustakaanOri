<?php

$pdo = dataBase::connect();
$peminjaman = Peminjaman::getInstance($pdo);

// Mengecek apakah pengguna memiliki role yang diizinkan untuk menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
   // Jika bukan super_admin, redirect ke halaman anggota dengan pesan error
   echo "<script>window.location = 'index.php?page=peminjaman&cek=rawrIzin';</script>";
   exit; // Menghentikan eksekusi script
}



if (isset($_GET['golkar']) && $_GET['golkar'] === 'hapus') {
    $id_peminjaman = $_GET['id_peminjaman'] ?? null;
    $id_buku = $_GET['id_buku'] ?? null;

    if ($id_peminjaman && $id_buku) {
        // Kode untuk menghapus data dari database
        // Pastikan untuk memvalidasi dan mengamankan input
        $pdo = dataBase::connect();
        $peminjaman = Peminjaman::getInstance($pdo);

        // Panggil metode hapus yang sesuai
        $peminjaman->hapusDetail($id_peminjaman, $id_buku);

        // Redirect atau tampilkan pesan sukses
        header("Location: index.php?page=peminjaman&act=detail&id_peminjaman=" . urlencode($id_peminjaman));
        exit();
    } else {
        die("ID peminjaman atau ID buku tidak ditemukan.");
    }
}



if(empty($_GET['id_peminjaman'])) {
   header("Location: index.php");
  } 
 
  $id_peminjaman = $_GET['id_peminjaman'];
 
  $pdo = dataBase::connect();
  $peminjaman = Peminjaman::getInstance($pdo);
  $result = $peminjaman->hapus($id_peminjaman);
  dataBase::disconnect();
  
  if ($result == true) {
     echo "<script>window.location.href = 'index.php?page=peminjaman&cek=del';</script>";
 } else {
    echo "<script>window.location.href = 'index.php?page=peminjaman&cek=failed';</script>";
 }
 

?>