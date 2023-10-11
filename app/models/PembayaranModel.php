<?php

class PembayaranModel{
  
    private $table = 'pembayaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    // Untuk Dasboard Admin
    public function top3_total_pembayaran(){
        $this->db->query("SELECT SUM(pembayaran.total_dibayar) as total_pendapatan,
            (SELECT avg(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS rating,
            (SELECT count(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS total_rating,
            user.*
            FROM pembayaran
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk
            LEFT JOIN user on produk.id_user = user.id_user
            WHERE pembayaran.status = 1
            GROUP BY produk.id_user
            ORDER BY total_pendapatan DESC
            LIMIT 3");
        return $this->db->resultSet();
    }
    // Untuk Dasboard Arsitek
    public function total_pembayaran(){
        $this->db->query("SELECT pembayaran.total_dibayar FROM pembayaran LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan LEFT JOIN produk ON produk.id_produk = pesanan.id_produk LEFT JOIN user on produk.id_user = user.id_user WHERE user.id_user = '".$this->cek_user()['id_user']."' AND (pembayaran.status = 1)");
        return $this->db->resultSet();
    }

    public function cek_pembayaran($id_pesanan, $pembayaran){
        $this->db->query("SELECT * FROM pembayaran WHERE id_pesanan = ".$id_pesanan." AND pembayaran = ".$pembayaran);
        return $this->db->single();
    }

    // Semua by admin
    public function semua_byadmin($status){
        $this->db->query("SELECT 
            pembayaran.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.judul as judul_produk
            FROM pembayaran 
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user 
            WHERE pembayaran.status = ".$status);
        return $this->db->resultSet();
    }
    public function laporan($status, $tanggal_awal, $tanggal_akhir){
        $this->db->query("SELECT
            SUM(pembayaran.total_dibayar) as total_telah_dibayar,
            SUM(pembayaran.pembayaran) as status_pembayaran, 
            pembayaran.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.judul as judul_produk
            FROM pembayaran 
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user 
            WHERE pembayaran.status = '$status'
            AND DATE(pembayaran.dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            GROUP BY pembayaran.id_pesanan
        ");
        return $this->db->resultSet();
    }
    public function detail_laporan($status, $tanggal_awal, $tanggal_akhir){
        $this->db->query("SELECT
            pembayaran.total_dibayar as total_telah_dibayar,
            pembayaran.pembayaran as status_pembayaran, 
            pembayaran.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.judul as judul_produk
            FROM pembayaran 
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user 
            WHERE pembayaran.status = '$status'
            AND DATE(pembayaran.dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            ORDER BY pembayaran.id_pesanan
        ");
        return $this->db->resultSet();
    }

    public function riwayat_pembayaran_byadmin($id_pesanan){
        $this->db->query("SELECT 
            pembayaran.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.id_produk as id_produk,
            produk.judul as judul_produk,
            pesanan.tawaran_harga
            FROM pembayaran 
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user 
            WHERE pembayaran.id_pesanan = ".$id_pesanan);
        return $this->db->resultSet();
    }

    public function pembayaran_byadmin($id_pembayaran){
        $this->db->query("SELECT 
            pembayaran.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.id_produk as id_produk,
            produk.judul as judul_produk,
            pesanan.tawaran_harga
            FROM pembayaran 
            LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user 
            WHERE pembayaran.id_pembayaran = ".$id_pembayaran);
        return $this->db->single();
    }

    public function update_status($id_pembayaran, $status){
        $this->db->query("UPDATE pembayaran SET status = ".$status.", diperbaharui_pada = '".date("Y-m-d H:i:s")."' WHERE id_pembayaran = '".$id_pembayaran."'");
        return $this->db->execute();
    }

    public function tahunan_semua_pembayaran(){
        $this->db->query("
            SELECT 
                SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
                SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
                SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
                SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
                SUM(IF(month = 'May', total, 0)) AS 'May',
                SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
                SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
                SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
                SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
                SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
                SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
                SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM (
                SELECT DATE_FORMAT(pembayaran.dibuat_pada, '%b') AS month, SUM(pembayaran.total_dibayar) as total 
                FROM pembayaran 
                LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
                LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
                LEFT JOIN user on produk.id_user = user.id_user 
                WHERE (pembayaran.dibuat_pada <= NOW() AND pembayaran.dibuat_pada >= Date_add(Now(),interval - 12 month)) 
                GROUP BY DATE_FORMAT(pembayaran.dibuat_pada, '%m-%Y')
            ) as sub
        ");
        return $this->db->resultSet();
    }

    public function tahunan_pembayaran(){
        $this->db->query("
            SELECT 
                SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
                SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
                SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
                SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
                SUM(IF(month = 'May', total, 0)) AS 'May',
                SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
                SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
                SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
                SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
                SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
                SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
                SUM(IF(month = 'Dec', total, 0)) AS 'Dec'
            FROM (
                SELECT DATE_FORMAT(pembayaran.dibuat_pada, '%b') AS month, SUM(pembayaran.total_dibayar) as total 
                FROM pembayaran 
                LEFT JOIN pesanan ON pembayaran.id_pesanan = pesanan.id_pesanan 
                LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
                LEFT JOIN user on produk.id_user = user.id_user 
                WHERE (user.id_user = '".$this->cek_user()['id_user']."' AND (pembayaran.status = 1)) 
                AND (pembayaran.dibuat_pada <= NOW() AND pembayaran.dibuat_pada >= Date_add(Now(),interval - 12 month)) 
                GROUP BY DATE_FORMAT(pembayaran.dibuat_pada, '%m-%Y')
            ) as sub
        ");
        return $this->db->resultSet();
    }

    public function tambah($data)
    {
        $this->db->query('INSERT INTO pembayaran (id_pesanan, bukti_pembayaran, total_dibayar, pembayaran, status, dibuat_pada, diperbaharui_pada) VALUES(:id_pesanan, :bukti_pembayaran, :total_dibayar, :pembayaran, :status, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_pesanan',$data['id_pesanan']);
        $this->db->bind('bukti_pembayaran',$data['bukti_pembayaran']);
        $this->db->bind('total_dibayar',$data['total_dibayar']);
        $this->db->bind('pembayaran',$data['pembayaran']);
        $this->db->bind('status',$data['status']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('UPDATE pembayaran SET bukti_pembayaran=:bukti_pembayaran, status=:status, diperbaharui_pada=:diperbaharui_pada WHERE id_pembayaran = '.$data['id_pembayaran']);
        $this->db->bind('bukti_pembayaran',$data['bukti_pembayaran']);
        $this->db->bind('status',$data['status']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}