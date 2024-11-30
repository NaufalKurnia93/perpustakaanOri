<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku</title>
</head>

<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header text-center">
        <h4 class="mb-0">Daftar Buku</h4>
      </div>
      <div class="card-body">
        <a href="index.php?page=buku&act=create" class="btn btn-info mb-3">TAMBAH DATA</a>

        <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
          <thead class="thead-light">
            <tr class="text-center">
              <th scope="col" class="font-weight-bold">No</th>
              <th scope="col" class="font-weight-bold">Judul</th>
              <th scope="col" class="font-weight-bold">Kategori</th>
              <th scope="col" class="font-weight-bold">Penulis</th>
              <th scope="col" class="font-weight-bold">Penerbit</th>
              <th scope="col" class="font-weight-bold">Tahun Terbit</th>
              <th scope="col" class="font-weight-bold">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            require_once 'database/koneksi.php';
            require_once 'database/class/buku.php';

            $pdo = dataBase::connect();
            $buku = Buku::getInstance($pdo);
            $dataBuku = $buku->getAll();
            $no = 1;

            foreach ($dataBuku as $row) {
              ?>
              <tr>
                <td class="text-center">
                  <?php echo $no++ ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['judul']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_kategori']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['nama_penulis']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['penerbit']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['tahun_terbit']); ?>
                </td>
                <td class="text-center">
                  <a href="index.php?page=buku&act=update&id_buku=<?php echo $row['id_buku'] ?>"
                    class="btn btn-info btn-sm">Edit</a>

                  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'super_admin') { ?>
                    <a href="index.php?page=buku&act=delete&id_buku=<?php echo $row['id_buku'] ?>"
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