<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penulis</title>
</head>

<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        Daftar Penulis
      </div>
      <div class="card-body">
        <a href="index.php?page=penulis&act=create" class="btn btn-info mb-3">TAMBAH DATA</a>

        <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
          <thead class="thead-light">
            <tr class="text-center">
              <th scope="col" class="font-weight-bold">No</th>
              <th scope="col" class="font-weight-bold">Nama</th>
              <th scope="col" class="font-weight-bold">Negara Kebangsaan</th>
              <th scope="col" class="font-weight-bold">Jumlah Karya</th>
              <th scope="col" class="font-weight-bold">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            require_once 'database/koneksi.php';
            require_once 'database/class/penulis.php';

            $pdo = dataBase::connect();
            $penulis = Penulis::getInstance($pdo);
            $datapenulis = $penulis->getAll();
            $no = 1;

            foreach ($datapenulis as $row) {
              ?>
              <tr>
                <td class="text-center">
                  <?php echo $no++ ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_penulis']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['asal_negara']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['jumlah_karya']) ?>
                </td>
                <td class="text-center">
                  <a href="index.php?page=penulis&act=update&id_penulis=<?php echo $row['id_penulis'] ?>"
                    class="btn btn-primary btn-sm">Edit</a>

                  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'super_admin') { ?>
                    <a href="index.php?page=penulis&act=delete&id_penulis=<?php echo $row['id_penulis'] ?>"
                      class="btn btn-danger btn-sm">Hapus</a>
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