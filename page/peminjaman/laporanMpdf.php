<?php
include "Vendor/autoload.php";
require_once 'database/koneksi.php';
require_once 'database/class/peminjaman.php';

try {
    $mpdf = new \Mpdf\Mpdf();

    // Mulai output buffering
    ob_start();

    // Mengambil data peminjaman dari database
    $pdo = dataBase::connect();
    $peminjaman = Peminjaman::getInstance($pdo);
    $dataPeminjaman = $peminjaman->getAll();

    // HTML untuk PDF
    ?>
    <h1>Data Peminjaman</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Petugas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataPeminjaman as $row) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_anggota']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_pinjam']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_kembali']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_petugas']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php

    // Tangkap dan bersihkan buffer output
    $html = ob_get_clean();

    // Tulis ke PDF
    $mpdf->WriteHTML($html);

    // Tampilkan PDF di browser
    $mpdf->Output("Data_Peminjaman.pdf", "I");
    exit;
} catch (\Mpdf\MpdfException $e) {
    // Menangkap error yang mungkin terjadi
    echo $e->getMessage();
}
?>
