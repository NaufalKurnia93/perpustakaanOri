<?php
include_once "database/class/kategori.php";
include_once "database/koneksi.php";

// var_dump($_GET); // cek debugging

$act = isset($_GET['act']) ? $_GET['act'] : '';
// echo "Action: " . $act . "<br>"; // Debugging variable act

switch ($act) {
    case 'create':
        include('tambah.php');
        break;

    case 'update':
        // echo "Including edit.php<br>"; // Debugging 
        include('edit.php');
        break;

    case 'delete':
        include('hapus.php');
        break;

    default:
        include('index.php');
        break;
}

