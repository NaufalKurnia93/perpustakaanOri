<?php 
class dataBase {
    private static $namaDb = 'perpustakaan-naufal';
    private static $namaHost = 'localhost';
    private static $namaUser = 'root';
    private static $password = '';


    private static $koneksi = null;

    public function __construct() {
        die('init function is not allowed');
    }

    public static function connect() {
        if ( null == self::$koneksi ) {
            try {
                self::$koneksi = new PDO( "mysql:host=" .self::$namaHost .   ";dbname=" . 
                self::$namaDb, self::$namaUser, self::$password);
                // echo "Koneksi berhasil!";
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }
    return self::$koneksi;
       
    }

    //cek koneksi 
    public static function checkConnection() {
        $pdo = self::connect();
        try {
            // Menggunakan query sederhana untuk memeriksa koneksi
            $query = $pdo->query('SELECT 1');
            if ($query) {
                echo "Koneksi berhasil!";
            } else {
                echo "Koneksi gagal!";
            }
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    public static function disconnect() {
        self::$koneksi = null;
    }
}

?>


