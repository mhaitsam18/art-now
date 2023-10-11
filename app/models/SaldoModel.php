<?php

class SaldoModel{
  
    private $table = 'saldo';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function semua(){
        $this->db->query("SELECT * FROM saldo ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }
    
    public function saldo(){
        $this->db->query("SELECT * FROM saldo WHERE id_user = ".$this->cek_user()['id_user']." ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }
    
    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO '.$this->table.' (id_user, nominal, keterangan, bukti, dibuat_pada) VALUES(:id_user, :nominal, :keterangan, :bukti, :dibuat_pada)');
        $this->db->bind('id_user',$data['id_user']);
        $this->db->bind('nominal',$data['nominal']);
        $this->db->bind('keterangan',$data['keterangan']);
        $this->db->bind('bukti',$data['bukti']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->execute();

        $arsitek = $this->arsitek($data['id_user']);
        $this->db->query("UPDATE arsitek SET saldo = ".($arsitek['saldo']+$data['nominal'])." WHERE id_user = '".$data['id_user']."'");
        return $this->db->execute();
    }

    
    public function laporan_keuangan($tanggal_awal, $tanggal_akhir){
        $this->db->query("SELECT user.*, saldo.*, saldo.dibuat_pada as dibuat_pada FROM saldo LEFT JOIN user ON user.id_user = saldo.id_user WHERE keterangan != 'Biaya admin penarikan saldo' AND DATE(saldo.dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        return $this->db->resultSet();
    }
    
    public function laporan(){
        $this->db->query("SELECT SUM(saldo.nominal) as saldo, user.*, COUNT(IF(saldo.keterangan = 'Penarikan saldo', 1, NULL)) as jumlah_penarikan, SUM(CASE WHEN saldo.keterangan = 'Biaya admin penarikan saldo' THEN (nominal * -1) ELSE 0 END) as biaya_admin, SUM(CASE WHEN saldo.keterangan = 'Penarikan saldo' THEN (nominal * -1) ELSE 0 END) as total_penarikan FROM saldo LEFT JOIN user ON user.id_user = saldo.id_user GROUP BY saldo.id_user ORDER BY saldo.dibuat_pada DESC");
        return $this->db->resultSet();
    }
    
    // arsitek dari id
    public function arsitek($id_user){
        $this->db->query("SELECT saldo FROM arsitek WHERE id_user = '".$id_user."'");
        return $this->db->single();
    }
    // User cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}