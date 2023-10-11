<?php

class ProdukModel{
  
    private $table = 'produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function semua(){
        $this->db->query("SELECT *, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk WHERE id_user = '".$this->cek_user()['id_user']."' AND status >= 0 ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }

    // By Guest
    public function index_byguest($order = null){
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.foto, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON produk.id_user = user.id_user WHERE produk.status = 1 AND user.status = 1 ORDER BY produk.dibuat_pada ".(($order == NULL) ? "DESC" : "ASC")." LIMIT 20");
        return $this->db->resultSet();
    }
    public function cari_byguest($cari, $kategori, $bintang){
        $kategori_query = $bintang_query = '';
        if($kategori && $kategori >= 0 && $kategori <= 5){
            $kategori_query = ' AND (kategori = "'.$kategori.'")';
        }
        if($bintang && $bintang > 0 && $bintang < 6){
            $bintang_query = ' HAVING rating >= '.$bintang.'';
        }
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.foto, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON produk.id_user = user.id_user LEFT JOIN arsitek ON user.id_user = arsitek.id_arsitek WHERE (produk.status = 1 AND user.status = 1) AND (nama_lengkap LIKE '%".$cari."%' OR user.email LIKE '%".$cari."%' OR user.telepon LIKE '%".$cari."%' OR arsitek.alamat LIKE '%".$cari."%' OR arsitek.deskripsi LIKE '%".$cari."%' OR produk.deskripsi LIKE '%".$cari."%' OR produk.judul LIKE '%".$cari."%')".$kategori_query.$bintang_query);
        return $this->db->resultSet();
    }
    public function semua_byguest($id_user){
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.foto, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON produk.id_user = user.id_user WHERE produk.id_user = '".$id_user."' AND produk.status = 1 ORDER BY produk.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function single_byguest($id_produk){
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.foto, user.email, user.telepon, user.dibuat_pada as user_dibuat_pada, arsitek.id_arsitek, arsitek.deskripsi as arsitek_deskripsi, arsitek.alamat, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON produk.id_user = user.id_user LEFT JOIN arsitek ON user.id_user = arsitek.id_user WHERE produk.id_produk = '".$id_produk."'");
        return $this->db->single();
    }

    // Laporan by Admin
    public function semua_byadmin($tanggal_awal, $tanggal_akhir){
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.email, user.telepon, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON user.id_user = produk.id_user WHERE produk.status >= 0 AND DATE(produk.dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function produk_arsitek_byadmin($id_user){
        $this->db->query("SELECT produk.*, user.nama_lengkap, user.email, user.telepon, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating FROM produk LEFT JOIN user ON user.id_user = produk.id_user WHERE produk.status >= 0 AND produk.id_user = '".$id_user."' ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }

    public function produk($id_produk){
        $this->db->query("SELECT *, (SELECT avg(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS rating, (SELECT count(rating) FROM rating WHERE rating.id_produk = produk.id_produk ) AS total_rating, (SELECT pesanan.status FROM pesanan WHERE pesanan.id_produk = produk.id_produk AND pesanan.status BETWEEN 0 AND 2 LIMIT 1) as status_pesanan FROM produk WHERE id_user = '".$this->cek_user()['id_user']."' AND id_produk = '".$id_produk."'");
        return $this->db->single();
    }

    public function calon_arsitek_produk($id_user){
        $this->db->query("SELECT * FROM produk WHERE id_user = '".$id_user."' ORDER BY id_produk DESC");
        return $this->db->single();
    }

    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO '.$this->table.' (id_user, judul, gambar, harga,  dokumen,  tautan_video,  kategori, deskripsi, status, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :judul, :gambar, :harga, :dokumen, :tautan_video, :kategori, :deskripsi, :status, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user',$user['id_user']);
        $this->db->bind('judul',$data['judul']);
        $this->db->bind('gambar',$data['gambar']);
        $this->db->bind('harga',$data['harga']);
        $this->db->bind('dokumen',$data['dokumen']);
        $this->db->bind('tautan_video',$data['tautan_video']);
        $this->db->bind('kategori',$data['kategori']);
        $this->db->bind('deskripsi',$data['deskripsi']);
        $this->db->bind('status',$data['status']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query('UPDATE '.$this->table.' SET judul= :judul, '. ($data['gambar'] ? "gambar = :gambar,":"") .' harga = :harga, '. ($data['dokumen'] ? "dokumen = :dokumen,":"") .' tautan_video = :tautan_video, kategori = :kategori, deskripsi = :deskripsi, diperbaharui_pada = :diperbaharui_pada WHERE id_produk = '.$data['id_produk']);
        $this->db->bind('judul',$data['judul']);
        if($data['gambar'] != null)
        {
            $this->db->bind('gambar',$data['gambar']);
        }
        $this->db->bind('harga',$data['harga']);
        if($data['dokumen'] != null)
        {
            $this->db->bind('dokumen',$data['dokumen']);
        }
        $this->db->bind('tautan_video',$data['tautan_video']);
        $this->db->bind('kategori',$data['kategori']);
        $this->db->bind('deskripsi',$data['deskripsi']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update_status_byadmin($id_user, $status){
        $this->db->query("UPDATE produk SET status = ".$status." WHERE id_user = '".$id_user."'");
        return $this->db->execute();
    }

    public function update_status($id_produk, $status){
        $this->db->query("UPDATE produk SET status = ".$status." WHERE id_user = '".$this->cek_user()['id_user']."' AND id_produk = '".$id_produk."'");
        return $this->db->execute();
    }

    public function hapus($id_produk){
        $this->db->query("DELETE FROM produk WHERE id_user = '".$this->cek_user()['id_user']."' AND id_produk = '".$id_produk."'");
        return $this->db->execute();
    }

    public function produk_rating($id_produk){
        $this->db->query("SELECT rating.*, user.nama_lengkap FROM rating LEFT JOIN user ON rating.id_user = user.id_user WHERE id_produk = '".$id_produk."' ORDER BY rating.dibuat_pada DESC");
        return $this->db->resultSet();
    }

    public function cek_produk($status){
        $this->db->query("SELECT * FROM produk WHERE id_user = '".$this->cek_user()['id_user']."' AND status = ".$status);
        return $this->db->resultSet();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}