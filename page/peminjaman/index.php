<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peminjaman</title>
</head>

<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header ">
        Daftar Peminjaman
        <div class="ml-auto mt-3">
        <a href="index.php?page=peminjaman&mpdf=pdf" class="btn btn-info mb-3">PDf</a>
        </div>
      </div>
      <div class="card-body ">
        <a href="index.php?page=peminjaman&act=create" class="btn btn-info mb-3">TAMBAH DATA</a>

        <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
          <thead class="thead-light">
            <tr class="text-center">
              <th scope="col" class="font-weight-bold">No</th>
              <th scope="col" class="font-weight-bold">Anggota</th>
              <th scope="col" class="font-weight-bold">Tanggal Pinjam</th>
              <th scope="col" class="font-weight-bold">Tanggal Kembali</th>
              <th scope="col" class="font-weight-bold">Petugas</th>
              <th scope="col" class="font-weight-bold">Status</th>
              <th scope="col" class="font-weight-bold">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            require_once 'database/koneksi.php';
            require_once 'database/class/peminjaman.php';

            $pdo = dataBase::connect();
            $peminjaman = Peminjaman::getInstance($pdo);
            $dataPeminjaman = $peminjaman->getAll();
            $no = 1;

            foreach ($dataPeminjaman as $row) {
              ?>
              <tr>
                <td class="text-center">
                  <?php echo $no++ ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_anggota']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['tanggal_pinjam']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['tanggal_kembali']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_petugas']); ?>
                </td>
                <td>
                  <?php
                  $status = htmlspecialchars($row['status']);
                  if ($status == 'selesai') {
                    echo '<span class="badge badge-success">Selesai</span>';
                  } else if ($status == 'berlangsung') {
                    echo '<span class="badge badge-warning">Berlangsung</span>';
                  }
                  ?>
                </td>

                <td class="text-center">
                  <a href="index.php?page=peminjaman&act=update&id_peminjaman=<?php echo $row['id_peminjaman'] ?>"
                    class="btn btn-info btn-sm" title="edit"><i class="fas fa-pencil-alt"></i>
                  </a>

              <a href="index.php?page=peminjaman&act=detail&id_peminjaman=<?php echo $row['id_peminjaman'] ?>"
                    class="btn btn-dark btn-sm " title="detail"><i class="fas fa-eye"></i>
                  </a>




                  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'super_admin') { ?>
                    <a href="index.php?page=peminjaman&act=delete&id_peminjaman=<?php echo $row['id_peminjaman'] ?>"
                      class="btn btn-danger btn-sm" title="hapus"><i class="fas fa-trash"></i>
                    </a>
                    <?php
                  }
                  ?>

                </td>
              </tr>
              <?php
            }
            dataBase::disconnect();
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</body>

</html>