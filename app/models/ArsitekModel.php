<?php

class ArsitekModel{
  
    private $table = 'arsitek';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO '.$this->table.' (id_user, deskripsi, alamat, ktp, ijazah, sertifikasi_arsitek, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :deskripsi, :alamat, :ktp, :ijazah, :sertifikasi_arsitek, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user',$user['id_user']);
        $this->db->bind('deskripsi',$data['deskripsi']);
        $this->db->bind('alamat',$data['alamat']);
        $this->db->bind('ktp',$data['ktp']);
        $this->db->bind('ijazah',$data['ijazah']);
        $this->db->bind('sertifikasi_arsitek',$data['sertifikasi_arsitek']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    
    // Arsitek by guest
    public function semua_arsitek()
    {
		$res = $this->db->query("SELECT user.*, arsitek.id_arsitek, arsitek.deskripsi, arsitek.alamat, (SELECT avg(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS rating, (SELECT count(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS total_rating FROM user LEFT JOIN arsitek ON user.id_user = arsitek.id_user WHERE user.status = 1 AND level = 1 LIMIT 20");
        return $this->db->resultSet();
    }

    public function profile_arsitek($id_user)
    {
		$res = $this->db->query("SELECT user.*, arsitek.id_arsitek, arsitek.deskripsi, arsitek.alamat, (SELECT avg(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS rating, (SELECT count(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS total_rating FROM user LEFT JOIN arsitek ON user.id_user = arsitek.id_user WHERE user.status = 1 AND level = 1 AND user.id_user = '".$id_user."'");
        return $this->db->single();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }

    // Update Rekening
    public function update_rekening($data) {
        $user = $this->cek_user();
        $this->db->query('UPDATE arsitek SET bank= :bank, nomor_rekening = :nomor_rekening, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$user['id_user']);
        $this->db->bind('bank',$data['bank']);
        $this->db->bind('nomor_rekening',$data['nomor_rekening']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    // Kosongkan rekening oleh admin
    public function kosongkan_rekening($data) {
        $this->db->query('UPDATE arsitek SET bank=NULL, nomor_rekening =NULL, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$data['id_user']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
}