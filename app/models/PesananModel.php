<?php

class PesananModel
{

    private $table = 'pesanan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Admin
    public function semua_byadmin($tanggal_awal, $tanggal_akhir)
    {
        $this->db->query(
            "SELECT pesanan.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.judul,
            (SELECT SUM(pembayaran.total_dibayar) FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.status=1 GROUP BY pembayaran.id_pesanan) as total_dibayar, 
            (SELECT COUNT(pembayaran.total_dibayar) FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.status=1 GROUP BY pembayaran.id_pesanan) as status_pembayaran
            FROM pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user
            WHERE DATE(pesanan.dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            ORDER BY pesanan.dibuat_pada DESC"
        );
        return $this->db->resultSet();
    }
    public function pesanan_byadmin($id_pesanan)
    {
        $this->db->query(
            "SELECT pesanan.*, 
            pengguna.id_user as id_pengguna,
            pengguna.nama_lengkap as nama_lengkap_pengguna, 
            pengguna.email as email_pengguna, 
            pengguna.telepon as telepon_pengguna, 
            arsitek.id_user as id_arsitek,
            arsitek.nama_lengkap as nama_lengkap_arsitek, 
            arsitek.email as email_arsitek, 
            arsitek.telepon as telepon_arsitek, 
            produk.judul,
            (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=-1 LIMIT 1) as status_pembayaran_dp, 
            (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=1 LIMIT 1) as status_pembayaran 
            FROM pesanan 
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
            LEFT JOIN user pengguna on pesanan.id_user = pengguna.id_user 
            LEFT JOIN user arsitek on produk.id_user = arsitek.id_user
            WHERE id_pesanan = " . $id_pesanan
        );
        return $this->db->single();
    }

    // Arsitek
    public function semua()
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap, produk.judul, (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=-1 LIMIT 1) as status_pembayaran_dp, (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=1 LIMIT 1) as status_pembayaran FROM pesanan LEFT JOIN user on user.id_user = pesanan.id_user LEFT JOIN produk ON produk.id_produk = pesanan.id_produk WHERE produk.id_user = '" . $this->cek_user()['id_user'] . "' ORDER BY pesanan.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function detail($id_pesanan)
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap, produk.judul, produk.harga, produk.kategori, (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=-1 LIMIT 1) as status_pembayaran_dp, (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=1 LIMIT 1) as status_pembayaran FROM pesanan LEFT JOIN user on user.id_user = pesanan.id_user LEFT JOIN produk ON produk.id_produk = pesanan.id_produk WHERE produk.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.id_pesanan = '" . $id_pesanan . "'");
        return $this->db->single();
    }

    // Untuk pengguna
    public function semua_bypengguna()
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap as nama_lengkap_arsitek, user.id_user as id_arsitek, produk.judul, (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=-1 LIMIT 1) as status_pembayaran_dp , (SELECT pembayaran.status FROM pembayaran WHERE pembayaran.id_pesanan = pesanan.id_pesanan AND pembayaran.pembayaran=1 LIMIT 1) as status_pembayaran FROM pesanan LEFT JOIN produk ON produk.id_produk = pesanan.id_produk LEFT JOIN user on user.id_user = produk.id_user WHERE pesanan.id_user = '" . $this->cek_user()['id_user'] . "' ORDER BY pesanan.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function sedang_bypengguna()
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap as nama_lengkap_arsitek, user.id_user as id_arsitek, produk.judul FROM pesanan LEFT JOIN produk ON produk.id_produk = pesanan.id_produk LEFT JOIN user on user.id_user = produk.id_user WHERE pesanan.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.status BETWEEN 0 AND 2");
        return $this->db->resultSet();
    }
    public function pesanan_bypengguna($id_pesanan)
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap as nama_lengkap_arsitek, user.id_user as id_arsitek, produk.judul, produk.harga, produk.kategori FROM pesanan LEFT JOIN produk ON produk.id_produk = pesanan.id_produk LEFT JOIN user on user.id_user = produk.id_user WHERE pesanan.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.id_pesanan = " . $id_pesanan . "");
        return $this->db->single();
    }
    public function hapus($id_pesanan)
    {
        $this->db->query("DELETE FROM pesanan WHERE status = 0 AND id_pesanan = '" . $id_pesanan . "'");
        return $this->db->execute();
    }

    public function pesanan($id_pesanan)
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap, produk.judul, produk.id_user as id_arsitek FROM pesanan LEFT JOIN user on user.id_user = pesanan.id_user LEFT JOIN produk ON produk.id_produk = pesanan.id_produk WHERE id_pesanan='" . $id_pesanan . "' AND produk.id_user = '" . $this->cek_user()['id_user'] . "'");
        return $this->db->single();
    }

    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO pesanan (id_user, id_produk, luas_tanah, detail, status, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :id_produk, :luas_tanah, :detail, :status, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user', $user['id_user']);
        $this->db->bind('id_produk', $data['id_produk']);
        $this->db->bind('luas_tanah', $data['luas_tanah']);
        $this->db->bind('detail', $data['detail']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('dibuat_pada', date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada', date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update_tawaran($id_pesanan, $tawaran_harga)
    {
        $this->db->query("UPDATE pesanan SET tawaran_harga = " . $tawaran_harga . ", diperbaharui_pada = '" . date("Y-m-d H:i:s") . "' WHERE id_pesanan = '" . $id_pesanan . "'");
        return $this->db->execute();
    }
    public function update_jadwal($id_pesanan, $jadwal_survei)
    {
        $this->db->query("UPDATE pesanan SET jadwal_survei = '" . $jadwal_survei . "', diperbaharui_pada = '" . date("Y-m-d H:i:s") . "' WHERE id_pesanan = '" . $id_pesanan . "'");
        return $this->db->execute();
    }

    public function update_status($id_pesanan, $status)
    {
        $this->db->query("UPDATE pesanan SET status = " . $status . ", diperbaharui_pada = '" . date("Y-m-d H:i:s") . "' WHERE id_pesanan = '" . $id_pesanan . "'");
        return $this->db->execute();
    }
    public function update_deadline($id_pesanan, $deadline)
    {
        $this->db->query("UPDATE pesanan SET deadline = '" . $deadline . "', diperbaharui_pada = '" . date("Y-m-d H:i:s") . "' WHERE id_pesanan = '" . $id_pesanan . "'");
        return $this->db->execute();
    }

    public function cek_pesanan($status)
    {
        $this->db->query("SELECT pesanan.*, user.nama_lengkap, produk.judul FROM pesanan LEFT JOIN user on user.id_user = pesanan.id_user LEFT JOIN produk ON produk.id_produk = pesanan.id_produk WHERE produk.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.status = " . $status . "");
        return $this->db->single();
    }

    // Untuk Dasboard Admin
    public function top3_total_pesanan()
    {
        $this->db->query("SELECT COUNT(*) as total_pesanan,
            (SELECT avg(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS rating,
            (SELECT count(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS total_rating,
            user.*
            FROM pesanan
            LEFT JOIN produk ON produk.id_produk = pesanan.id_produk
            LEFT JOIN user on produk.id_user = user.id_user
            WHERE pesanan.status BETWEEN 0 AND 3
            GROUP BY user.id_user
            ORDER BY total_pesanan DESC
            LIMIT 3");
        return $this->db->resultSet();
    }
    // Untuk Dasboard Arsitek
    public function total_pesanan()
    {
        $this->db->query("SELECT pesanan.id_pesanan FROM pesanan LEFT JOIN produk ON produk.id_produk = pesanan.id_produk LEFT JOIN user on produk.id_user = user.id_user WHERE user.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.status BETWEEN 0 AND 3");
        return $this->db->resultSet();
    }

    public function tahunan_semua_pesanan()
    {
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
                SELECT DATE_FORMAT(pesanan.dibuat_pada, '%b') AS month, COUNT(pesanan.id_pesanan) as total 
                FROM pesanan 
                LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
                LEFT JOIN user on produk.id_user = user.id_user 
                WHERE (pesanan.status BETWEEN 0 AND 3) AND (pesanan.dibuat_pada <= NOW() AND pesanan.dibuat_pada >= Date_add(Now(),interval - 12 month)) 
                GROUP BY DATE_FORMAT(pesanan.dibuat_pada, '%m-%Y')
            ) as sub
        ");
        return $this->db->resultSet();
    }

    public function tahunan_pesanan()
    {
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
                SELECT DATE_FORMAT(pesanan.dibuat_pada, '%b') AS month, COUNT(pesanan.id_pesanan) as total 
                FROM pesanan 
                LEFT JOIN produk ON produk.id_produk = pesanan.id_produk 
                LEFT JOIN user on produk.id_user = user.id_user 
                WHERE (user.id_user = '" . $this->cek_user()['id_user'] . "' AND pesanan.status BETWEEN 0 AND 3) 
                AND (pesanan.dibuat_pada <= NOW() AND pesanan.dibuat_pada >= Date_add(Now(),interval - 12 month)) 
                GROUP BY DATE_FORMAT(pesanan.dibuat_pada, '%m-%Y')
            ) as sub
        ");
        return $this->db->resultSet();
    }

    // Arsitek cek
    public function cek_user()
    {
        $this->db->query("SELECT * FROM user WHERE email = '" . $_SESSION['email'] . "'");
        return $this->db->single();
    }
}
