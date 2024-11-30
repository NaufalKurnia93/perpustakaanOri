<?php

$pdo = dataBase::connect();
$peminjaman = Peminjaman::getInstance($pdo);
$id_peminjaman = $_GET['id_peminjaman'];


// Jika tombol "Simpan" ditekan
if (isset($_POST['save'])) {
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $id_buku = htmlspecialchars($_POST['id_buku']);
    $denda = htmlspecialchars($_POST['denda']);

    $peminjaman->tambahDetail($id_peminjaman, $id_buku, $denda);

    // Redirect ke halaman detail dengan parameter id_peminjaman
    header("Location: index.php?page=peminjaman&act=detail&id_peminjaman=" . urlencode($id_peminjaman));
    exit;
}
if (isset($_POST['selesaikan_peminjaman'])) {
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    // Proses penyelesaian peminjaman
    if ($peminjaman->selesaikanPeminjaman($id_peminjaman)) {
        // Redirect ke halaman peminjaman setelah selesai
        header("Location: index.php?page=peminjaman");
        exit;
    } else {
        echo "Gagal menyelesaikan peminjaman.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<body>

    <!-- Form Simpan Pinjam Peminjaman -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
            <form method="POST">
                <div class="row">
                        <div class="card border border-primary shadow col-3 d-flex align-self-start">
                            <div class="card-body py-4">
                                <div class="form-group row">
                                    <label class="col-form-label text-md-right">ID Buku</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectric" name="id_buku">
                                            <?php
                                            $rows = $peminjaman->getBook($id_peminjaman);
                                            foreach ($rows as $row):
                                                ?>
                                                <option value="<?= $row['id_buku'] ?>">
                                                    <?= $row['id_buku'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <hr class="sidebar-divider d-none d-md-block">

                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="save">
                                    Tambah
                                </button>
                            </div>
                        </div>

                        <div class="card shadow col-sm-8 offset-1 align-items-start">
                            <div class="card-header row">

                                <div class="form-group col-5 mb-4">
                                    <label class="col-form-label text-md-right">ID Pinjam</label>
                                    <input type="text" class="form-control bg-info text-light" name="id_peminjaman"
                                        value="<?= htmlspecialchars($id_peminjaman) ?>" readonly>
                                </div>

                                <div class="col-2 mb-4 pb-2">
                                    <a href="index.php?page=peminjaman" class="btn btn-secondary shadow">Kembali</a>
                                </div>
                            </div>
                    </form>

                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Denda</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $i = 1;
                        $rows = $peminjaman->getDetail($id_peminjaman);
                        foreach ($rows as $row):
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?= $i++ ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row["judul"] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row["penerbit"] ?>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    $badgeClass = '';
                                    $statusText = '';

                                    switch ($row["status"]) {
                                        case 'Belum Dikonfirmasi':
                                            $badgeClass = 'badge-danger';
                                            $statusText = 'Belum Dikonfirmasi';
                                            break;
                                        case 'Dikonfirmasi':
                                            $badgeClass = 'badge-success';
                                            $statusText = 'Dikonfirmasi';
                                            break;
                                        default:
                                            $badgeClass = 'badge-secondary';
                                            $statusText = 'Status Tidak Diketahui';
                                            break;
                                    }
                                    ?>
                                    <span class="badge <?= htmlspecialchars($badgeClass) ?>">
                                        <?= htmlspecialchars($statusText) ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-danger btn-action mr-3" data-toggle="tooltip" title="Delete"
                                            data-confirm="Apakah Anda Yakin Ingin Menghapus Data Dari Peminjaman?"
                                            data-confirm-yes="window.location.href='index.php?page=peminjaman&act=delete&golkar=hapus&cek=del&id_peminjaman=<?= htmlspecialchars($row['id_peminjaman']) ?>&id_buku=<?= htmlspecialchars($row['id_buku']) ?>'">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <!-- Tombol selesaikan peminjaman -->
                                        <form action="index.php?page=peminjaman&act=proses" method="post">
                                            <input type="hidden" name="id_peminjaman"
                                                value="<?php echo htmlspecialchars($id_peminjaman); ?>">
                                            <button type="submit" class="btn btn-primary" name="selesaikan_peminjaman"
                                                title="selesaikan"> <i class="fas fa-check"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>




</body>

</html>