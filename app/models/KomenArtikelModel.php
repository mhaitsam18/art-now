<?php

class KomenArtikelModel{
  
    private $table = 'komen_artikel';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function semua($id_artikel, $status_reply = null){
        $this->db->query("SELECT user.*, komen_artikel.*FROM komen_artikel LEFT JOIN user ON user.id_user = komen_artikel.id_user WHERE komen_artikel.id_artikel = '".$id_artikel."' ".(($status_reply != null) ? " AND id_reply_komen IS NOT NULL":" AND id_reply_komen IS NULL")." ORDER BY komen_artikel.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO komen_artikel (id_user, id_artikel, id_reply_komen, komen, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :id_artikel, :id_reply_komen, :komen, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user',$user['id_user']);
        $this->db->bind('id_artikel',$data['id_artikel']);
        $this->db->bind('id_reply_komen',$data['id_reply_komen']);
        $this->db->bind('komen',$data['komen']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    public function hapus($id_komen){
        $this->db->query("DELETE FROM komen_artikel WHERE id_komen = '".$id_komen."' OR id_reply_komen = '".$id_komen."'");
        return $this->db->execute();
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}