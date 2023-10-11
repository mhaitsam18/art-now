<?php

class PermintaanPenarikanModel{
  
    private $table = 'permintaan_penarikan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function semua(){
        $this->db->query("SELECT *, permintaan_penarikan.dibuat_pada as tanggal, permintaan_penarikan.status as status_permintaan FROM permintaan_penarikan LEFT JOIN user ON user.id_user = permintaan_penarikan.id_user LEFT JOIN arsitek on arsitek.id_user = user.id_user WHERE permintaan_penarikan.status = 0 ORDER BY permintaan_penarikan.dibuat_pada DESC");
        return $this->db->resultSet();
    }

    public function detail($id_permintaan_penarikan){
        $this->db->query("SELECT *, permintaan_penarikan.dibuat_pada as tanggal, permintaan_penarikan.status as status_permintaan FROM permintaan_penarikan LEFT JOIN user ON user.id_user = permintaan_penarikan.id_user LEFT JOIN arsitek on arsitek.id_user = user.id_user WHERE permintaan_penarikan.id_permintaan_penarikan = ".$id_permintaan_penarikan." AND permintaan_penarikan.status = 0 ORDER BY permintaan_penarikan.dibuat_pada DESC");
        return $this->db->single();
    }
    
    public function update_status($id_permintaan_penarikan, $status){
        $this->db->query("UPDATE permintaan_penarikan SET status = ".$status.", diperbaharui_pada = '".date("Y-m-d H:i:s")."' WHERE id_permintaan_penarikan = '".$id_permintaan_penarikan."'");
        return $this->db->execute();
    }
    
    public function permintaan_penarikan(){
        $this->db->query("SELECT * FROM permintaan_penarikan WHERE id_user = ".$this->cek_user()['id_user']." AND status = 0 ORDER BY dibuat_pada DESC");
        return $this->db->single();
    }
    
    public function tarik_saldo()
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO '.$this->table.' (id_user, dibuat_pada, diperbaharui_pada) VALUES(:id_user, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('id_user',$user['id_user']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    // User cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}