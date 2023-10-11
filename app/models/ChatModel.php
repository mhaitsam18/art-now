<?php

class ChatModel{
  
    private $table = 'pesan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function riwayat_chat($cari){
        $id_user = $this->cek_user()['id_user'];
        $cari_cond = '';
        if($cari !== '!'){
            $cari_cond = "AND ((pengirim.nama_lengkap LIKE '%".$cari."%' AND NOT pesan.id_user_dari = ".$id_user.") OR (penerima.nama_lengkap LIKE '%".$cari."%' AND NOT pesan.id_user_kepada = ".$id_user.")) ";
        }
        $this->db->query(
            "SELECT 
            pesan.id_pesan, 
            MAX(pesan.id_pesan) as new_id_pesan, 
            pesan.id_user_dari, 
            pesan.id_user_kepada, 
            COUNT(CASE WHEN pesan.status = 0 AND id_user_kepada = ".$id_user." THEN 1 END) as jumlah_belum_dibaca, 
            MAX(pesan.dibuat_pada) as dibuat_pada, 
            pengirim.nama_lengkap as nama_pengirim, 
            pengirim.level as level_pengirim, 
            pengirim.foto as foto_pengirim, 
            penerima.nama_lengkap as nama_penerima, 
            penerima.level as level_penerima, 
            penerima.foto as foto_penerima 
            FROM pesan 
            LEFT JOIN user pengirim ON pengirim.id_user = id_user_dari 
            LEFT JOIN user penerima ON penerima.id_user = id_user_kepada 
            WHERE (id_user_dari = ".$id_user." OR id_user_kepada = ".$id_user.") ".$cari_cond." 
            GROUP BY id_user_dari, id_user_kepada 
            ORDER BY new_id_pesan DESC"
        );
        return $this->db->resultSet();
    }
    public function chat($id_user_with){
        $id_user = $this->cek_user()['id_user'];
        $this->db->query(
            "SELECT 
            pesan.*, 
            pengirim.nama_lengkap as nama_pengirim, 
            penerima.nama_lengkap as nama_penerima
            FROM pesan 
            LEFT JOIN user pengirim ON pengirim.id_user = id_user_dari 
            LEFT JOIN user penerima ON penerima.id_user = id_user_kepada 
            WHERE (id_user_dari = ".$id_user." OR id_user_kepada = ".$id_user.") AND (id_user_dari = ".$id_user_with." OR id_user_kepada = ".$id_user_with.") 
            ORDER BY pesan.dibuat_pada DESC"
        );
        return $this->db->resultSet();
    }

    public function kirim_chat($data)
    {
        $this->db->query('INSERT INTO pesan (id_user_dari, id_user_kepada, tipe, pesan, status, dibuat_pada) VALUES('.$this->cek_user()['id_user'].', :id_user_kepada, :tipe, :pesan, 0, :dibuat_pada)');
        $this->db->bind('id_user_kepada',$data['id_user_kepada']);
        $this->db->bind('tipe',$data['tipe']);
        $this->db->bind('pesan',$data['pesan']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update_status($id_user_with, $status){
        $id_user = $this->cek_user()['id_user'];
        $this->db->query("UPDATE pesan SET status = ".$status." WHERE id_user_dari = '".$id_user_with."' AND id_user_kepada = '".$id_user."'");
        return $this->db->execute();
    }

    // User cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }

    public function cek_from_id($data){
        $this->db->query("SELECT * FROM user WHERE id_user = '".$data['id_user']."'");
        return $this->db->single();
    }
}