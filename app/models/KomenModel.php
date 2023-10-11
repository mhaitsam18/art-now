<?php

class KomenModel{
  
    private $table = 'komen';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function semua($id_produk, $status_reply = null){
        $this->db->query("SELECT komen.*, user.* FROM komen LEFT JOIN user ON user.id_user = komen.id_user WHERE komen.id_produk = '".$id_produk."' ".(($status_reply != null) ? " AND id_reply_komen IS NOT NULL":" AND id_reply_komen IS NULL")." ORDER BY komen.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO komen (id_user, id_produk, id_reply_komen, komen, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :id_produk, :id_reply_komen, :komen, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user',$user['id_user']);
        $this->db->bind('id_produk',$data['id_produk']);
        $this->db->bind('id_reply_komen',$data['id_reply_komen']);
        $this->db->bind('komen',$data['komen']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    public function hapus($id_komen){
        $this->db->query("DELETE FROM komen WHERE id_komen = '".$id_komen."' OR id_reply_komen = '".$id_komen."'");
        return $this->db->execute();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}