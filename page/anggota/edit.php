<?php

if (empty($_GET['id_anggota'])) {
    header("location: index.php?page=anggota");
    exit(); // kode selanjut nya tidak akan di eksekusi
}

$id_anggota = $_GET['id_anggota'];
$pdo = dataBase::connect();
$anggota = Anggota::getInstance($pdo);

// Jika tombol 'save' ditekan
if (isset($_POST['save'])) {
    $nama_anggota   = htmlspecialchars($_POST['nama_anggota']);
    $alamat         = htmlspecialchars($_POST['alamat']);
    $no_telpon      = htmlspecialchars($_POST['no_telpon']);

    // Coba edit data anggota dan cek hasilnya
    if ($anggota->edit($id_anggota, $nama_anggota, $alamat, $no_telpon)) {
        header("location: index.php?page=anggota&cek=updt");
        exit();
    } else {
        echo "maaf data gagal di simpan";
    }

    // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
} else {
    $data = $anggota->getID($id_anggota);
    if (!$data) {
        header("location: index.php?page=anggota");
        exit();
    }

    //// Ambil data anggota untuk ditampilkan di form
    $nama_anggota   = htmlspecialchars($data['nama_anggota']);
    $alamat         = htmlspecialchars($data['alamat']);
    $no_telpon      = htmlspecialchars($data['no_telpon']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
</head>

<body>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>EDIT ANGGOTA</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="form-group">
                                <label>Nama</label>
                                <input name="nama_anggota" type="text" class="form-control"
                                    placeholder="Masukkan Nama Lengkap" required
                                    value="<?php echo htmlspecialchars($nama_anggota); ?>">
                            </div>


                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>"
                                    placeholder="Masukkan alamat" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" name="no_telpon" value="<?php echo htmlspecialchars($no_telpon); ?>"
                                    placeholder="Masukkan nomor handphone" class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-warning">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>