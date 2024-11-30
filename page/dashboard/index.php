<?php

// Include file class
include_once 'database/koneksi.php';
include_once 'database/class/dashboard.php';

// Inisialisasi objek dan mendapatkan koneksi database
$koneksi = dataBase::connect(); // Gunakan metode statis untuk mendapatkan koneksi
$report = new Report($koneksi); // Inisialisasi objek Report dengan koneksi

// Ambil data untuk chart
$chartData = $report->peminjaman_anggotaforchart();

// Query SQL dan kode lainnya untuk menghitung jumlah table data yang ada
$sqlAnggota = 'SELECT COUNT(*) FROM anggota';
$resultAnggota = $pdo->query($sqlAnggota);
$jumlah_anggota = $resultAnggota->fetchColumn();

$sqlBuku = 'SELECT COUNT(*) FROM buku';
$resultBuku = $pdo->query($sqlBuku);
$jumlah_buku = $resultBuku->fetchColumn();

$sqlPeminjaman = 'SELECT COUNT(*) FROM peminjaman';
$resultPeminjaman = $pdo->query($sqlPeminjaman);
$jumlah_peminjaman = $resultPeminjaman->fetchColumn();

$sqlPenulis = 'SELECT COUNT(*) FROM penulis';
$resultPenulis = $pdo->query($sqlPenulis);
$jumlah_penulis = $resultPenulis->fetchColumn();

$sqlPetugas = 'SELECT COUNT(*) FROM petugas';
$resultPetugas = $pdo->query($sqlPetugas);
$jumlah_petugas = $resultPetugas->fetchColumn();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <style>
    .main-style-2 {
      padding-left: 100px;
    }

    .row-style2 {
      margin-left: -60px;
      margin-right: -20px;
    }
  </style>
</head>

<body>
  <!-- Main Content -->
  <div class="container-fluid  ">
    <section class="section ">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>

      <div class="section-body text-dark">

        <div class="row justify-content-center">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa-solid  fa-user fa-beat-fade h3"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Jumlah Anggota</h4>
                </div>
                <div class="card-body">
                  <?= $jumlah_anggota ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-success">
                <i class="fa-solid fa-handshake fa-beat-fade h3"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total peminjaman</h4>
                </div>
                <div class="card-body">
                  <?= $jumlah_peminjaman ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                <i class="fa fa-book fa-beat-fade h3"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Buku</h4>
                </div>
                <div class="card-body">
                  <?= $jumlah_buku ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                <i class="fa-solid fa-users fa-beat-fade h3"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>jumlah petugas</h4>
                </div>
                <div class="card-body">
                  <?= $jumlah_petugas ?>
                </div>
              </div>
            </div>
          </div>

        </div>



        <div class="card">
          <div class="card-header">
            <h4>Report Peminjaman </h4>
          </div>
          <div class="card-body p-3t">
            <canvas id="myCharts"></canvas>
            <div class="statistic-details mt-1">
            </div>
          </div>

        </div>


      </div>
    </section>
  </div>
 

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labels = 
    <?= json_encode($chartData['labels']); ?>;
    const data = {
      labels: labels,
      datasets: [
        {
          label: 'Jumlah',
          backgroundColor: 'rgb(75, 192, 192)',
          borderColor: 'Blue',
          data:  <?= json_encode($chartData['data']); ?>, 
          borderWidth: 1
        }
      ]


    };

    const config = {
      type: 'bar',
      data: data,
      options: {}
    };


    var myChart = new Chart(
      document.getElementById('myCharts'),
      config
    );
  </script>
</body>

</html>