<?php

class NotifikasiModel{
  
    private $table = 'notifikasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function semua(){
        $this->db->query("SELECT * FROM notifikasi WHERE id_user=".$this->cek_user()['id_user']." ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function belum_dilihat(){
        $this->db->query("SELECT * FROM notifikasi WHERE id_user=".$this->cek_user()['id_user']." AND status = 0");
        return $this->db->resultSet();
    }
    public function lihat(){
        $this->db->query("UPDATE notifikasi SET status = 1 WHERE id_user = '".$this->cek_user()['id_user']."'");
        return $this->db->execute();
    }
    public function bersihkan(){
        $this->db->query("DELETE FROM notifikasi WHERE id_user = '".$this->cek_user()['id_user']."'");
        return $this->db->execute();
    }

    public function notifikasi($data)
    {
        $this->db->query('INSERT INTO '.$this->table.' (id_user, judul, keterangan, link, status, dibuat_pada) VALUES(:id_user, :judul, :keterangan, :link, :status, :dibuat_pada)');
        $this->db->bind('id_user',$data['id_user']);
        $this->db->bind('judul',$data['judul']);
        $this->db->bind('keterangan',$data['keterangan']);
        $this->db->bind('link',$data['link']);
        $this->db->bind('status',0);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}