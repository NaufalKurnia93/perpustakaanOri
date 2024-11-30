<?php 
class Report {
    private $koneksi;
    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }
    
    public function peminjaman_Anggota() {
    //Pilih nama anggota dengan alias nama_anggota, Hitung jumlah peminjaman dengan alias total_peminjaman
        $sql = 'SELECT a.nama_anggota AS nama_anggota,  COUNT(p.id_peminjaman) AS total_peminjaman FROM peminjaman p JOIN anggota a ON p.id_anggota =a.id_anggota GROUP BY a.id_anggota'; // -- Kelompokkan hasil per anggota berdasarkan kolom id_anggota
        
    $stmt = $this->koneksi->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function peminjaman_anggotaforchart() {
        $data = $this->peminjaman_Anggota();
        $labels = [];
        $values = [];

        foreach ($data as $row) {
           $labels[] = $row['nama_anggota'];
           $values[] = $row['total_peminjaman'];
        }
        return [
            'labels' => $labels,
            'data' => $values
        ];
    }
}
?>
