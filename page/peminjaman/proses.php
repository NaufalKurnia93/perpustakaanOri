<?php
$peminjaman = Peminjaman::getInstance($pdo);


// Cek jika tombol selesaikan peminjaman ditekan
if (isset($_POST['selesaikan_peminjaman'])) {
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $peminjaman->selesaikanPeminjaman($id_peminjaman);
    header("Location: index.php?page=peminjaman&cek=end");
    exit;
}




if (isset($_POST['konfirmasi_denda'])) {
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $denda = htmlspecialchars($_POST['denda']);
 // Log data sebelum diproses
 error_log("Konfirmasi denda: id_peminjaman=$id_peminjaman, denda=$denda");

 $peminjaman->konfirmasiDenda($id_peminjaman, $denda);
 
 // Log data setelah konfirmasi
 error_log("Redirecting to: index.php?page=peminjaman&act=denda&id_peminjaman=" . urlencode($id_peminjaman));    
 // SweetAlert untuk konfirmasi berhasil
 echo '
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     Swal.fire({
         title: "Berhasil!",
         text: "Denda telah dikonfirmasi.",
         icon: "success",
         confirmButtonText: "OK"
     }).then((result) => {
         if (result.isConfirmed) {
             // Redirect setelah SweetAlert dikonfirmasi
             window.location.href = "index.php?page=peminjaman&act=detail&id_peminjaman=' . urlencode($id_peminjaman) . '";
         }
     });
 </script>';
    exit;
}

?>





