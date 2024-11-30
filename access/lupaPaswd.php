<?php
include_once "database/koneksi.php";
include_once "database/class/access.php";

$pdo = dataBase::connect();
$user = Access::getInstance($pdo); // Mendapatkan instance dari kelas Access

if (isset($_POST["reset"])) {
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
 
  if ($user->lupaPaswd($email, $password)) {
    echo "<script>window.location = 'index.php?access=forget&cek=pass';</script>";
  } else {
    echo "<script>window.location = 'index.php?access=forget&cek=rawr2';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>


  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
  <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_GET['cek'])) { ?>
                switch ("<?php echo $_GET['cek']; ?>") {
                    case "pass":
                        Swal.fire({
                            icon: "success",
                            title: 'Berhasil Mengganti Password!',
                            text: 'jangan lupa pasword mu seperti melupakan dia.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php?auth=login.php';
                            }
                        });
                        break;
                    case "rawr2":
                        Swal.fire({
                            icon: "error",
                            title: 'terjadi eror mohon periksa kembali',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        break;
                }
            <?php } ?>
        });
    </script>

</head>


<body class="bg-primary bg-gradient">
  <div class="container mt-3 p-5">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <div class="card shadow">
          <div class="card-header">
            <h5 class="fw-bold ">Reset Pasword</h5>
          </div>
          <div class="card-body p-5">
            <form action="" method="POST">

              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="text" class="form-control" name="email" tabindex="1" autocomplete="off" required
                  autofocus>
                <div class="invalid-feedback">
                  masukkan alamat email
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password"
                  placeholder="Enter new password" required>
              </div>

              <div class="d-grid">
                <input type="submit" class="btn btn-primary" name="reset" value="Reset Password">
              </div>

            </form>
          </div>
          <a href="index.php?access=login" type="submit" class="btn mb-3 mx-4 btn-info">kembali</a>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>
</body>

</html>