<footer class="bg-light text-center py-3 pd">
  <div class="container">
    <span class="text-muted">&copy; 2024 Perpustakaan Naufal. All Rights Reserved.</span>
  </div>
</footer>

<!-- sweet alert start  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  <?php
  if (isset($_GET['cek']) && $_GET['cek'] == "add") {
    ?>

    Swal.fire({
      icon: "success",
      title: "data berhasil di tambahkan",
      showConfirmButton: false,
      timer: 1500
    });

  <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "updt") { ?>
    Swal.fire({
      icon: "success",
      title: "data berhasil di simpan",
      showConfirmButton: false,
      timer: 1500
    });

  <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "del") { ?>
    Swal.fire({
      icon: "success",
      title: 'Items telah dihapus!',
      showConfirmButton: false,
      timer: 1500
    });

  <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "passed") { ?>
    Swal.fire({
      icon: 'success',
      title: 'login berhasil',
      text: 'selamat datang dan selamat mengomentari.'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php?access=login.php';
      }
    });


  <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "rawrIzin") { ?>
    Swal.fire({
      icon: "error",
      title: 'Tidak izin akses',
      text: 'Anda Tidak Memiliki Izin Untuk Halaman Ini!',
      showConfirmButton: false,
      timer: 3000
    });

  <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "konfir") { ?>
    Swal.fire({
      icon: "error",
      title: "MAAf...",
      text: "silahkan konfirmasi denda terlebih dahulu !",
      // footer: '<a href="#">Why do I have this issue?</a>'
    });

    <?php } elseif (isset($_GET['cek']) && $_GET['cek'] == "end") { ?>

    Swal.fire({
      icon: "success",
      title: "Selamat Peminjaman Telah Dituntaskan",
      showConfirmButton: false,
      timer: 1500
    });

 

    <?php
  }
  ?>


</script>