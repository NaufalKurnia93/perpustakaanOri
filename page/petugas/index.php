<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petugas</title>
</head>

<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        Daftar Petugas
      </div>
      <div class="card-body ">
        <a href="index.php?page=petugas&act=create" class="btn btn-info mb-3">TAMBAH DATA</a>

        <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
          <thead class="thead-light">
            <tr class="text-center">
              <th scope="col" class="font-weight-bold">No</th>
              <th scope="col" class="font-weight-bold">Nama</th>
              <th scope="col" class="font-weight-bold">Jenis Kelamin</th>
              <th scope="col" class="font-weight-bold">Alamat</th>
              <th scope="col" class="font-weight-bold">Jabatan</th>
              <th scope="col" class="font-weight-bold">Shift</th>
              <th scope="col" class="font-weight-bold">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            require_once 'database/koneksi.php';
            require_once 'database/class/petugas.php';

            $pdo = dataBase::connect();
            $petugas = Petugas::getInstance($pdo);
            $dataPetugas = $petugas->getAll();
            $no = 1;

            foreach ($dataPetugas as $row) {
              ?>
              <tr>
                <td class="text-center">
                  <?php echo $no++ ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_petugas']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['jenis_kelamin']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['alamat']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['jabatan']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['shift']) ?>
                </td>
                <td class="text-center">
                  <a href="index.php?page=petugas&act=update&id_petugas=<?php echo $row['id_petugas'] ?>"
                    class="btn btn-info btn-sm">Edit</a>

                  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'super_admin') { ?>
                    <a href="index.php?page=petugas&act=delete&id_petugas=<?php echo $row['id_petugas'] ?>"
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