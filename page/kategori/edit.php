<?php

if (empty($_GET['id_kategori'])) {
    header("location: index.php?page=kategori");
    exit(); // kode selanjut nya tidak akan di eksekusi
}

$id_kategori = $_GET['id_kategori'];
$pdo = dataBase::connect();
$kategori = Kategori::getInstance($pdo);

// Jika tombol 'save' ditekan
if (isset($_POST['save'])) {
    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);

    // Coba edit data kategori dan cek hasilnya
    if ($kategori->edit($id_kategori, $nama_kategori)) {
        header("location: index.php?kategori&cek=updt");
        exit();
    } else {
        echo "maaf data gagal di simpan";
    }

    // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
} else {
    $data = $kategori->getID($id_kategori);
    if (!$data) {
        header("location: index.php?page=kategori");
        exit();
    }

    //// Ambil data kategori untuk ditampilkan di form
    $nama_kategori = htmlspecialchars($data['nama_kategori']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit kategori</title>
</head>

<body>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>EDIT kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama_kategori" id="nama_kategori"
                                    value="<?php echo htmlspecialchars($nama_kategori); ?>"
                                    placeholder="Masukkan nama anda" class="form-control">
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