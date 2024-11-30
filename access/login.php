<?php
include_once "database/koneksi.php";
include_once "database/class/access.php";

$pdo = dataBase::connect();
$user = Access::getInstance($pdo);

// jika login di jalankan
if (isset($_POST['login'])) {
    // Mengambil dan membersihkan input dari form
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if ($user->login($username, $password)) {
        header("Location: index.php?access=login&cek=passed");
        exit();
    } else {
        header("Location: index.php?access=login&cek=rawr3");
        exit();
    }

}
?>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <title>Login Account</title>
</head>

<body class="bg-primary">
    <div class="container mt-5">
        <section class="section">
            <?php if (isset($_GET['cek'])): ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        <?php
                        if ($_GET['cek'] == "rawr3") {
                            ?>
                            Swal.fire({
                                icon: 'error',
                                title: 'username atau Password salah',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        <?php } elseif ($_GET['cek'] == "logout") { ?>
                            Swal.fire({
                                icon: 'success',
                                title: 'Logout Berhasil',
                                showConfirmButton: false,
                                timer: 2500
                            });

                            <?php
                          }
                        ?>
                    });
                </script>
            <?php endif; ?>
            <div class="row ">
                <div class="col-sm-5 offset-sm-4 ">

                    <div id="notifikasi">
                        <div class="alert alert-info text-dark ">
                            <small>Login Anda Gagal, Periksa Kembali Username dan Password</small>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-block">
                            <div class="login-brand m-0 p-1">
                                <img src="assets/img/avatar/avatar-3.png" alt="logo" width="100"
                                    class="shadow-light rounded-circle">
                            </div>
                            <h4 class="card-title text-center">Sign in</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" class="form-control" placeholder="masukkan username"
                                        type="text" required="required" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" placeholder="******" type="password"
                                        required="required" autocomplete="off">
                                    <div class="float-right">
                                        <a href="index.php?access=forget" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="login" class="btn btn-primary btn-block"> Login
                                    </button>
                                </div>

                            </form>
                            <div class="pt-2 text-center text-muted ">
                                <p>Belum Memiliki Akun?. <a href="index.php?access=register">Buat Akun</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="col-sm-4 ">
                </div>
            </div>
        </section>
    </div>
</body>


<script src="assets/modules/jquery.min.js"></script>
<script src="assets/modules/popper.js"></script>
<script src="assets/modules/tooltip.js"></script>
<script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="assets/modules/moment.min.js"></script>
<script src="assets/js/stisla.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>

</html>